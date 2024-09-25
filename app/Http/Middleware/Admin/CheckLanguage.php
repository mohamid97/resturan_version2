<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;

class CheckLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the lang property is present in the request headers
        if ($request->hasHeader('lang')) {
            // Retrieve the value of the lang property from headers
            $lang = $request->header('lang');
            // Set the application's locale to the specified lang
            app()->setLocale($lang);
        }else{
            app()->setLocale('ar');
        }
        return $next($request);
    }
}
