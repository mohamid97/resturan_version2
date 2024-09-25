<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AddressResource;
use App\Http\Resources\Admin\UserAddressResource;
use App\Http\Resources\Admin\UserDetailsResource;
use App\Http\Resources\Admin\UsersResource;
use App\Mail\ChangePassword;
use App\Models\Admin\Address;
use App\Models\Admin\Lang;
use App\Models\User;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str; // Import Str facade
class UsersController extends Controller
{
    use ResponseTrait;
    public function get()
    {
        $users = User::all();
        return  $this->res(true ,'All Users' , 200 ,UsersResource::collection($users));
    }


    // login from api 

    public function Api_login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $user = User::where('email', $request->email)->where('type' , 'user')->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return  $this->res(false ,'Invaild Login creedintenal' , 401);

        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return  $this->res(true ,'access_token' , 200 ,['token'=>$token , 'token_type' => 'Bearer' ,  'user'=>new UserDetailsResource($user)]);

      //  return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
    }

    // get user details 
    public function user_details(Request $request){
        
        try{
            $request->validate([
                'user_id'=>'required|integer'
            ]);
            $user = User::findOrFail($request->user_id);
            if($user->type == 'admin'){
                return $this->res(false , 'Canot Get This User ( Un Authorized )' , 401 );
            }
            return  $this->res(true ,'user details' , 200 ,new UserDetailsResource($user));
        }catch(\Exception $e){
            return  $this->res(false ,'Error Happend' , $e->getCode() , $e->getMessage());

        }

    }  // end function get user details

    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'password' => 'required|string|min:6',
                'email' => 'required|email|unique:users,email',
                'phone'=>'required'
            ], [
                'first_name.required' => 'First name is required.',
                'first_name.string' => 'First name must be a string.',
                'phone.required' => 'phone is required.',
                'first_name.max' => 'First name may not be greater than 255 characters.',
                'last_name.required' => 'Last name is required.',
                'last_name.string' => 'Last name must be a string.',
                'last_name.max' => 'Last name may not be greater than 255 characters.',
                'email.required' => 'Email address is required.',
                'email.email' => 'The email address must be a valid email format.',
                'email.unique' => 'The email address has already been taken.',
                'avatar.image' => 'The avatar must be an image file.',
                'avatar.mimes' => 'The avatar must be a file of type: jpeg, png, jpg, gif, svg.',
                'avatar.max' => 'The avatar may not be greater than 2MB.',
            ]);
    
            // Initialize image name
            $image_name = null;
    
            // Handle the image upload if present
            if ($request->hasFile('avatar')) {
                $image_name = time() . '-' . $request->file('avatar')->getClientOriginalName();
                $request->file('avatar')->move(public_path('uploads/images/users'), $image_name);
            }
    
            // Start database transaction
            DB::beginTransaction();
    
            // Create a new user
            $user = new User();
            $user->first_name = $validatedData['first_name'];
            $user->last_name  = $validatedData['last_name'];
            $user->password   = Hash::make($validatedData['password']);
            $user->email      = $validatedData['email'];
            $user->phone      = $validatedData['phone'];
            $user->type       = 'user';
            $user->avatar     = $image_name; // Assign the image name or null if no image
            $user->save();
    
            // Commit the transaction
            DB::commit();
    
            // Return a success response with user details
            return  $this->res(true , 'User details saved successfully.'  ,  200 ,  new UserDetailsResource($user));

 
    
        }catch (ValidationException $e) {
            DB::rollBack();
           // Handle validation exceptions
            return  $this->res(false , 'Validation failed: '  ,  422 ,   ['errors' => $e->errors()]);
           
       } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
            return  $this->res(false , 'An error occurred while saving user details.' , 500 , $e->getMessage());
        }

    }



    public function change_password(Request $request){
        try{

                // Validate the request data
                $validatedData = $request->validate([
                'last_password' => 'required|min:6',
                'new_password' => 'required|min:6',

            ], [
                'last_password.required' => 'Last Password is required.',
                'last_password.min' => 'Last Password may not be Less than 6 characters..',
                'new_password.required' => 'New Password is required.',
                'new_password.min' => 'New Password may not be Less than 6 characters..',
            ]);   

            DB::beginTransaction();
             $user = $request->user();
             if($user->password = Hash::make($request->last_password)){
                $user->password = Hash::make($request->new_password);
                $user->save();
                DB::commit();

                return  $this->res(true , 'Password Changed successfully.'  ,  200 ,  new UserDetailsResource($user));

             }
             return  $this->res(false , 'Invaild Password'  ,  401 );


        }catch(\Exception $e){
                // Rollback the transaction in case of an error
                DB::rollBack();
                return  $this->res(false , 'An error occurred while saving user details.' , 500 , $e->getMessage());
        }
    }


   // refresh token 
   public function refresh_token(Request $request)
   {
   
    
      $refreshToken = $request->bearerToken();
      $user = User::where('refresh_token', $refreshToken)->first();

       $user->tokens()->delete(); // Revoke all tokens
       $newToken = $user->createToken('auth_token')->plainTextToken;
       return  $this->res(true ,  'access_token' , 200 ,  ['access_token'=>$newToken , 'token_type' => 'Bearer']);

   }


   public function user_profile(Request $request){
     return  $this->res(true ,'user_profile' , 200    , new UserDetailsResource($request->user()) );

   }



  

   public function edit_profile(Request $request)
   {
       try {

        DB::beginTransaction();
           // Validate the request data
           $validatedData = $request->validate([
               'first_name' => 'required|string|max:255',
               'last_name' => 'required|string|max:255',
               'email' => 'required|email|unique:users,email,' . $request->user()->id,
               'avatar' => 'nullable|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',
               'phone'=>'required'
           ], [
            'first_name.required' => 'First name is required.',
            'first_name.string' => 'First name must be a string.',
            'first_name.max' => 'First name may not be greater than 255 characters.',
            'last_name.required' => 'Last name is required.',
            'last_name.string' => 'Last name must be a string.',
            'last_name.max' => 'Last name may not be greater than 255 characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'The email address must be a valid email format.',
            'email.unique' => 'The email address has already been taken.',
            'avatar.image' => 'The avatar must be an image file.',
            'avatar.mimes' => 'The avatar must be a file of type: jpeg, webp , png, jpg, gif, svg.',
            'avatar.max' => 'The avatar may not be greater than 2MB.',
            'phone.required' => 'phone is required.',
        ]);
   
           // Get the authenticated user
           $user = $request->user();
   
           if (!$user) {
             return  $this->res(false , 'User Not Found' , 404);
           }
   
           // Initialize the image name with the current avatar
           $image_name = $user->avatar;
   
           // Handle the image upload if present
           if ($request->hasFile('avatar')) {
               $image = $request->file('avatar');
               $image_name = time() . '-' . $image->getClientOriginalName();
               $image->move(public_path('uploads/images/users'), $image_name);
           }
   

           // Update the user profile
           $user->update([
               'first_name' => $validatedData['first_name'],
               'last_name' => $validatedData['last_name'],
               'email' => $validatedData['email'],
               'avatar' => $image_name,
               'phone' => $validatedData['phone']
           ]);
           DB::commit();
           return  $this->res(true ,'Profile updated successfully' , 200 , new UserDetailsResource($user));
   
       } catch (ValidationException $e) {
            DB::rollBack();
           // Handle validation exceptions
            return  $this->res(false , 'Validation failed: '  ,  422 ,   ['errors' => $e->errors()]);
           
       } catch (\Exception $e) {
           DB::rollBack();
           return  $this->res(false , 'An error occurred while updating the profile. Please try again later. '  , $e->getCode() ,  ['errors' => $e->getMessage()]);
       }
   }


   public function logout(Request $request){
        // Get the current authenticated user
        $user = $request->user();
    
        // Revoke the current user's token
        if ($user) {
            $user->currentAccessToken()->delete();
            
            // Optionally, you can return a success response
            return  $this->res(true ,'User Logged out successfully' , 200);
        }
        return  $this->res(false , 'User Didnot exist'  , 404 );


    } // end logout function 

    // get all address 
    public function all_address(Request $request){
        $addresses = Address::with(['gov', 'city', 'user'])
        ->where('user_id', $request->user()->id)
        ->whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        })
        ->get();
        return  $this->res(true ,'All Address For User' , 200 , AddressResource::collection($addresses));
 
    }


    public function get_address(Request $request){
        try{
                // Validate the request data
            $validatedData = $request->validate([
                'address_id'=>'required|integer',

            ], [
                'address_id.required' => 'Address is required.',
                'address_id.integer' => 'Address must be an interger.',


            ]);  
            
            $addresses = Address::with(['gov', 'city', 'user'])
            ->where('user_id', $request->user()->id)
            ->where('id' , $request->address_id)
            ->whereHas('translations', function ($query) {
                $query->where('locale', '=', app()->getLocale());
            })
            ->first();
            return  $this->res(true ,'All Address For User' , 200 , new AddressResource($addresses));

        }catch (ValidationException $e) {
           // Handle validation exceptions
            return  $this->res(false , 'Validation failed: '  ,  422 ,   ['errors' => $e->errors()]);
           
       }catch(\Exception $e){
            return  $this->res(false ,'Error ' , $e->getCode() , $e->getMessage());

        }

 
    }


    // edit address
    public function edit_address(Request $request){
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'address_id'=>'required|integer',
                'gov_id' => 'required|integer',
                'city_id' => 'required|integer',
                'address.*' => 'required|string',
                'is_default'=>'required|in:0,1'

            ], [
                'address_id.required' => 'Address is required.',
                'address_id.integer' => 'Address must be an interger.',
                'gov_id.required' => 'Gov is required.',
                'gov_id.integer' => 'Gov must be an interger.',
                'city_id.required' => 'City is required.',
                'city_id.integer' => 'City must be an interger.',
                'address.required' => 'address is required.',
                'address.string' => 'address must be string.',
                'is_default.required'=>'is default requierd'


            ]);

    
            // Start database transaction
            DB::beginTransaction();
            $user = $request->user();

            if($validatedData['is_default'] == '1'){
                Address::query()->update([
                    'default'=> '0'
                ]);
            }
    
            // Create a new user
            $address =  Address::where('id' , $request->address_id)->where('user_id' , $user->id)->first();
            if(isset($address)){
                $address->gov_id = $validatedData['gov_id'];
                $address->city_id = $validatedData['city_id'];
                $address->default = $validatedData['is_default'];
                foreach (Lang::all() as $lang) {
                    $address->{'address:'.$lang->code} = $request->address[$lang->code];
                }
                $address->save();
                
                // Commit the transaction
                DB::commit();
        
                // Return a success response with user details
                return  $this->res(true , 'address Added Successfully!'  ,  200 ,  new UserAddressResource($user->load('address')));


            }
           
            return  $this->res(false , 'Address Not Founded '  ,  404);


        }catch (ValidationException $e) {
            DB::rollBack();
           // Handle validation exceptions
            return  $this->res(false , 'Validation failed: '  ,  422 ,   ['errors' => $e->errors()]);
           
       } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
            return  $this->res(false , 'An error occurred while saving user details.' , 500 , $e->getMessage());
        }
    }

    public function store_address(Request $request) {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'gov_id' => 'required|integer',
                'city_id' => 'required|integer',
                'address.*' => 'required|string',
                'is_default'=>'required|in:0,1'

            ], [
                'gov_id.required' => 'Gov is required.',
                'gov_id.integer' => 'Gov must be a string.',
                'city_id.required' => 'City is required.',
                'city_id.integer' => 'City must be a string.',
                'address.required' => 'address is required.',
                'address.string' => 'address must be string.',
                'is_default.required'=>'is default requierd'


            ]);

    
            // Start database transaction
            DB::beginTransaction();
            $user = $request->user();

            if($validatedData['is_default'] == '1'){
                Address::query()->update([
                    'default'=> '0'
                ]);
            }
    
            // Create a new user
            $address = new Address();
            $address->user_id = $user->id;
            $address->gov_id = $validatedData['gov_id'];
            $address->city_id = $validatedData['city_id'];
            $address->default = $validatedData['is_default'];
            foreach (Lang::all() as $lang) {
                $address->{'address:'.$lang->code} = $request->address[$lang->code];
            }
            $address->save();
            
            // Commit the transaction
            DB::commit();
            
            // Return a success response with user details
            return  $this->res(true , 'address Added Successfully!'  ,  200 ,  new UserAddressResource($user->load('address')));

        }catch (ValidationException $e) {
            DB::rollBack();
           // Handle validation exceptions
            return  $this->res(false , 'Validation failed: '  ,  422 ,   ['errors' => $e->errors()]);
           
       } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
            return  $this->res(false , 'An error occurred while saving user details.' , 500 , $e->getMessage());
        }

    }

    public function delete_address(Request $request){
        try{
            $user = $request->user();
            $addres = Address::find($request->address_id);
            if(isset($addres)){
                $addres->delete();
                return  $this->res(true , 'address Deleted Successfully!'  ,  200  , new UserDetailsResource($user));
            }
            return  $this->res(false , 'Failed To Delete Address'  ,  404  , 'Address Doesnot Exists');

        }catch(\Exception $e){
            return  $this->res(false , 'Failed To Delete Address'  ,  $e->getCode()  , $e->getMessage());

        }


    }



    // start rest password

    public function rest_password(Request $request){
     
        try{
            // Validate the request data
            $validatedData = $request->validate([
                'email' => 'required|email',
            ], [
                'email.required' => 'Email is required.',

            ]);

            $user = User::where('email' , $request->email)->where('type' , 'user')->first();
            if(isset($user)){
                $rest_code = Str::random(40);
                $user->rest_password_code = $rest_code;
                //dd('dsds');
                $resetLink = 'https://restaurant-template-sooty.vercel.app/reset-password?token=' . $rest_code; // Generate or fetch the reset token
                Mail::to($request->email)->send(new ChangePassword($resetLink));

               return  $this->res(true , 'Email Sent ! Check Your Email'  ,  200  , new UserDetailsResource($user));


            }
            return  $this->res(false , 'Email Not Found'  ,  404 );

        }catch (ValidationException $e) {
            DB::rollBack();
           // Handle validation exceptions
            return  $this->res(false , 'Validation failed: '  ,  422 ,   ['errors' => $e->errors()]);
           
       }catch(\Exception $e){
            return  $this->res(false , 'Failed To Delete Address'  ,  $e->getCode()  , $e->getMessage());

        }
    }


    public function check_rest_code(Request $request){
        try{
            // Validate the request data
            $validatedData = $request->validate([
                'rest_password_code' => 'required|string',
            ], [
                'rest_password_code.required' => 'Rest Password Code is required.',

            ]);

            $user = User::where('rest_password' , $request->rest_password_code)->first();
            if(isset($user)){

                $newToken = $user->createToken('auth_token')->plainTextToken;
                return  $this->res(true ,  'access_token' , 200 ,  ['access_token'=>$newToken , 'token_type' => 'Bearer' , 'user'=>new UserDetailsResource($user)]);
            
            }
            return  $this->res(false , 'Email Not Found'  ,  404 );

        }catch (ValidationException $e) {
            DB::rollBack();
           // Handle validation exceptions
            return  $this->res(false , 'Validation failed: '  ,  422 ,   ['errors' => $e->errors()]);
           
       }catch(\Exception $e){
            return  $this->res(false , 'Failed To Delete Address'  ,  $e->getCode()  , $e->getMessage());

        }
    }



    
   





}
