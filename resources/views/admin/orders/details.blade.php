@extends('admin.layout.master')

@section('content')



        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <h1>@lang('sidebar.order_details') </h1>
                    </div>
                    <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">@lang('main.home') </a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.orders') </li>
                    </ol>
                    </div>
                </div>
            </div>
        </section>
    <section class="content">
    <div class="container-fluid">
    <div class="row">
    <div class="col-12">
        <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> @lang('main.details_of') :</h5>
            {{ $order->user->first_name .' '. $order->user->last_name }}
        </div>
    
    <div class="invoice p-3 mb-3">
    
            <div class="row">
                <div class="col-12">
                    <h4>
                    <i class="fas fa-user"></i> @lang('main.general_information')
                    <small class="float-right">Date: {{$order->created_at }}</small>
                    </h4>
                </div>
            
            </div>
    
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
               <strong> @lang('main.user_information') </strong>
                <address>
                    @lang('main.name'): {{ $order->user->first_name .' '. $order->user->last_name }}<br>
                    @lang('main.phone'): {{ $order->user->phone }}<br>
                    @lang('main.email'): {{ $order->user->email }}
                </address>
            </div>


            <div class="col-sm-4 invoice-col">
            
                <strong>@lang('sidebar.order_details')</strong>
                <address>
                
                    @lang('main.total_price'): {{ $total_price}} @lang('main.egp')<br>
                    @lang('main.total_quntity') : {{ $total_quantity }} <br>
                    @lang('main.city')           : {{ $order_city_price->name}} <br>
                    @lang('main.shiping_price')  : {{ isset($order_city_price->price->price) ? $order_city_price->price->price : '0 EGP'  }}
                
                </address>
            </div>



            <div class="col-sm-4 invoice-col">
            
                <strong>@lang('sidebar.order_payment') </strong>
                <address>
                
                    @lang('main.status'): {{ $order->status }}<br>
                    @lang('main.payment_status') : {{ $order->payment_status }} <br>
                    @lang('main.payment_status') : {{ $order->payment_method }} <br>

                
                </address>
            </div>
        

        

        
        </div>
    
    
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>   @lang('main.gallery')</th>
                        <th>   @lang('sidebar.product_name')</th>
                        <th>   @lang('main.price')</th>
                        <th>   @lang('main.quntity')</th>
                        <th>   @lang('main.total')</th>
                    
                    </tr>
                    </thead>
                <tbody>
                    @foreach ($order->items as $index => $item )

                    <tr>
                        <td>{{ $index  + 1  }}</td>
                        <td>


                            <div class="row" style="width:250px">

                                <div class="col-md-12">
                                    <div class="card">
                                    
                                    <div class="card-body" style="padding:0 !important;">
                                    <div id="carouselExampleIndicators{{ $index + 1 }}" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">

                                        
                                        @foreach ($item->product->gallery as $indexs => $ga)
                                       

                                            <li data-target="#carouselExampleIndicators{{ $index + 1 }}" data-slide-to="{{ $indexs }}" class=""></li>

                                        @endforeach

                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach ($item->product->gallery as $indexs => $ga)
                                            <div class="carousel-item active">
                                            <img style="height: 200px !important" class="d-block w-100" src="{{ asset('uploads/images/gallery/' . $ga->photo) }}" alt="Third slide">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators{{ $index + 1 }}" role="button" data-slide="prev">
                                    <span class="carousel-control-custom-icon" aria-hidden="true">
                                    <i class="fas fa-chevron-left"></i>
                                    </span>
                                    <span class="sr-only"> @lang('main.previous')</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators{{ $index + 1 }}" role="button" data-slide="next">
                                    <span class="carousel-control-custom-icon" aria-hidden="true">
                                    <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <span class="sr-only"> @lang('main.next')</span>
                                    </a>
                                    </div>
                                    </div>
                                    
                                    </div>
                                    
                                    </div>
                            </div>







                        </td>
                        <td>{{ $item->product->translations[0]->name }}</td>
                        <td>{{ $item->product->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->quantity  * $item->product->price  }}  @lang('main.egp')</td>
                    </tr>
                    @endforeach

                </tbody>
                </table>
            </div>
        
        </div>



    

    
    


    </div>
    
    </div>
    </div>
    </div>
    </section>
    





@endsection