@extends('admin.layout.master')
@section('styles')
<style>
 .pay_header{
    width: 100%;
    display: flex;
    justify-content: space-between;
 }
 .pay_header img{
    border: 3px solid #f1f1f1;

 }
</style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Status</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item ">Payments </li>
                        <li class="breadcrumb-item active">Status </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

       
          <div class="row">

            @if (isset($paymob))
            <div class="col-md-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title pay_header">PayMob

                         <img height="40px" width="60px" src="data:image/png;base64,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">

                        </h3>
                    </div>
                    <form method="post" action="{{ route('admin.payments.edit_status') }}">
                        @csrf
                        <input type="hidden" name="payment_method" value="paymob" />
                        <div class="card-body">


                            <div class="form-group">

                                <div class="row">
                                    <div class="col-md-8">
                                        <lable>Enable/Disabled -  Paymob </lable>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="custom-control custom-checkbox">
                                            <input {{($paymob->status ?'checked':'')}} name="status" type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1"></label>
                                        </div>
                                    </div>
                                </div>
                                @error('status')
                                <div class="text-danger">{{ $errors->first('status') }}</div>
                                @enderror
                            </div>



    
                        </div>


                        <div class="card-footer">
                            <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> Submit</button>
                           
                        </div>
    
                    </form>
                </div>
            </div>
            @endif



            @if (isset($paypal))
            <div class="col-md-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title pay_header">Paypal
                            <img height="40px" width="60px" src="https://tunisie-telegraph.com/wp-content/uploads/2022/05/paypal.jpg">
                        </h3>
                    </div>
                    <form method="post" action="{{ route('admin.payments.edit_status') }}">
                        @csrf
                        <input type="hidden" name="payment_method" value="paypal" />
                        <div class="card-body">


                            <div class="form-group">

                                <div class="row">
                                    <div class="col-md-8">
                                        <lable>Enable/Disabled -  Paypal </lable>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="custom-control custom-checkbox">
                                            <input {{($paypal->status ?'checked':'')}} name="status" type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2"></label>
                                        </div>
                                    </div>
                                </div>
                                @error('status')
                                <div class="text-danger">{{ $errors->first('status') }}</div>
                                @enderror
                            </div>



    
                        </div>


                        <div class="card-footer">
                            <button type="submit" class="btn btn-info"><i class="nav-icon fas fa-paper-plane"></i> Submit</button>
                           
                        </div>
    
                    </form>
                </div>
            </div>
            @endif







            @if (isset($stripe))
            <div class="col-md-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title pay_header">Stripe
                              <img height="40px" width="60px" src="data:image/png;base64,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">

                        </h3>
                    </div>
                    <form method="post" action="{{ route('admin.payments.edit_status') }}">
                        @csrf
                        <input type="hidden" name="payment_method" value="stripe" />
                        <div class="card-body">


                            <div class="form-group">

                                <div class="row">
                                    <div class="col-md-8">
                                        <lable>Enable/Disabled -  Stripe </lable>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="custom-control custom-checkbox">
                                            <input {{($stripe->status ?'checked':'')}} name="status" type="checkbox" class="custom-control-input" id="customCheck3">
                                            <label class="custom-control-label" for="customCheck3"></label>
                                        </div>
                                    </div>
                                </div>
                                @error('status')
                                <div class="text-danger">{{ $errors->first('status') }}</div>
                                @enderror
                            </div>



    
                        </div>


                        <div class="card-footer">
                            <button type="submit" class="btn btn-info"><i class="nav-icon fas fa-paper-plane"></i> Submit</button>
                           
                        </div>
    
                    </form>
                </div>
            </div>
            @endif








          </div>




        </div>
    </section>
@endsection
