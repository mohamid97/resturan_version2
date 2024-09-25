<?php

namespace App\Exceptions;

use App\Trait\ResponseTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Laravel\Sanctum\PersonalAccessToken;

class Handler extends ExceptionHandler
{
    use ResponseTrait;
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }



    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
    
        if ($exception instanceof AuthenticationException) {
           
            if ($request->expectsJson()) {
          
                $token = $request->bearerToken();
    
                if ($token) {
                    $accessToken = PersonalAccessToken::findToken($token);
                    
                    if ($accessToken && $accessToken->expires_at < now()) {
                        return  $this->res(false ,'Token expired. Please refresh your token.'  , 401    , 'Token expired. Please refresh your token.');

                    }
                }
    
                return  $this->res(false ,'Unauthenticated'  , 401    , 'Unauthenticated');

            }
      
            return redirect()->guest(route('login'));
        }

        if ($exception instanceof UnauthorizedHttpException) {
            if ($request->expectsJson()) {
           
                return  $this->res(false ,'Unauthenticated' , 401   , 'Unauthenticated');
            } else {
              
                // Redirect to login page for web requests
                return redirect()->guest(route('login'))->withErrors([
                    'error' => 'Your token is invalid. Please log in again.'
                ]);
            }
        }

        return parent::render($request, $exception);
    }










}



