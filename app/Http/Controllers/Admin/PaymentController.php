<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Payment;
use App\Models\Admin\Paymmob;
use App\Models\Admin\Paypal;
use App\Models\Admin\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Bool_;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    //
    public function get(){
        $paymob = Paymmob::first();
        $stripe = Stripe::first();
        $paypal = Paypal::first();
        return view('admin.payments.index' , ['paymob'=>$paymob , 'stripe' => $stripe , 'paypal'=>$paypal]);
    }
    public function settings(Request $request){
        try{
           
            $request->validate([
                'payment_method' => 'required'
            ]);

            if($request->payment_method == 'paymob'){
               return  $this->edit_paymob_settings($request);

            }else if($request->payment_method == 'stripe'){
                return  $this->edit_stripe_settings($request);

            }else if($request->payment_method == 'paypal'){
                return  $this->edit_paypal_settings($request);

            }

            

        }catch(\Exception $e){
            // If an exception occurs, rollback the transaction
            DB::rollBack();
    
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.payments.index');

        }
        
    }

    //edit paypal 

    private function edit_paypal_settings(Request $request) {
      
        $request->validate([
            'paypal_client_id'=>'required|string',
            'paypal_client_secret'=>'required|string'
        ]);

      
        DB::beginTransaction();
        $paypal = Paypal::first();   
      
        if(isset($paypal)){
          
            $paypal->update([
                'paypal_client_id' => $request->paypal_client_id,
                'paypal_client_secret'=> $request->paypal_client_secret,
            ]);
          
        
        }else{

            if(!$this->checkSlug($request->payment_method)){
                $payment = Payment::create([
                    'slug' =>'paypal',
                   ]);
            }
     
            Paypal::create([
            'paypal_client_id' => $request->paypal_client_id,
            'paypal_client_secret'=> $request->paypal_client_secret,
            ]);

        }
        DB::commit();
        Alert::success('Success', 'Updated Successfully ! !');
        return redirect()->route('admin.payments.index');  
    }

    private function edit_stripe_settings(Request $request){
        $request->validate([
            'stripe_key'=>'required|string',
            'stripe_secret'=>'required|string'
        ]);

      
        DB::beginTransaction();
        $stripe = Stripe::first();   
      
        if(isset($stripe)){
          
            $stripe->update([
                'stripe_key' => $request->stripe_key,
                'stripe_secret'=> $request->stripe_secret,
            ]);
          
        
        }else{
            if(!$this->checkSlug($request->payment_method)){
                $payment = Payment::create([
                    'slug' =>'stripe',
                   ]);

            }
                
            Stripe::create([
            'stripe_key' => $request->stripe_key,
            'stripe_secret'=> $request->stripe_secret,
            ]);

        }
        DB::commit();
        Alert::success('Success', 'Updated Successfully ! !');
        return redirect()->route('admin.payments.index');
    }

    // edit paymob setting
    private function edit_paymob_settings(Request $request){

            $request->validate([
                'paymob_api'=>'required',
                'paymob_card_id'=>'required',
                'paymob_card_iframe'=>'required',
                'paymob_wallet_id'=>'required'
            ]);

          
            DB::beginTransaction();
            $paymob = Paymmob::first();   
          
            if(isset($paymob)){
              
                $paymob->update([
                    'paymob_api' => $request->paymob_api,
                    'paymob_card_id'=> $request->paymob_card_id,
                    'paymob_card_iframe'=>$request->paymob_card_iframe,
                    'paymob_wallet_id'=>$request->paymob_wallet_id
                ]);
              
            
            }else{

                if(!$this->checkSlug($request->payment_method)){
                    $payment = Payment::create([
                        'slug' =>'paymob',
                       ]);

                }
    
                Paymmob::create([
                'paymob_api' => $request->paymob_api,
                'paymob_card_id'=> $request->paymob_card_id,
                'paymob_card_iframe'=>$request->paymob_card_iframe,
                'paymob_wallet_id'=>$request->paymob_wallet_id
                ]);

            }
            DB::commit();
            Alert::success('Success', 'Updated Successfully ! !');
            return redirect()->route('admin.payments.index');
    

    }


    // get all status of payments methods

    public function get_status(){
        
        return view('admin.payments.status' , [
            'paymob'=>Payment::where('slug' , 'paymob')->first(),
            'paypal'=>Payment::where('slug' , 'paypal')->first(),
            'stripe'=>Payment::where('slug' , 'stripe')->first(),
        ]);
        
    }



    public function edit_status(Request $request){

     
        $request->validate([
            'payment_method'=>'required',
        ]);

        try{
            DB::beginTransaction();
                          
            Payment::where('slug' , $request->payment_method)->update([
                'status'=> $request->status == 'on' ? '1' : '0'
            ]);

            DB::commit();
            Alert::success('Success', 'Updated Successfully ! !');
            return redirect()->route('admin.payments.status');

        }catch(\Exception $e){
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.payments.status');
        }


        
    }


    // check if payment medthod added
    private function checkSlug($slug) {
        $payment = Payment::where('slug' , $slug)->first();
        if(isset($payment)){
            return true;
        }

        return false;

    }



}
