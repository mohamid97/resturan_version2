@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.points_price') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home') </a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.points_price') </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.points_price')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.points_pirce.update' , ['id'=> $point->id])}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">

                        <div class="border  p-3">
                    
                            <div class="form-group">
                                <label for="points">@lang('sidebar.points') </label>
                                <input type="number" name="points" class="form-control" id="points" placeholder="@lang('plachoder.enter_points') " value="{{isset($point->num_points)?$point->num_points:''}}">
                                @error('points')
                                <div class="text-danger">{{ $errors->first('points') }}</div>
                                @enderror
                            </div>
               
                        </div>
                        <br>


                        <div class="border  p-3">
                    
                            <div class="form-group">
                                <label for="points">@lang('main.pounds') </label>
                                <input type="number" name="pounds" class="form-control" id="Pounds" placeholder="@lang('plachoder.enter_pounds')" value="{{isset($point->num_pounds)?$point->num_pounds:''}}">
                                @error('Pounds')
                                <div class="text-danger">{{ $errors->first('Pounds') }}</div>
                                @enderror
                            </div>
               
                        </div>
                        <br>
                       <br>
                        <br>

                        <div class="border  p-3">
                    
                            <div class="form-group">
                                <label for="order_amount">@lang('main.order_amount') </label>
                                <input type="text" name="order_amount" class="form-control" id="order_amount" placeholder="@lang('plachoder.enter_order_amount')" value="{{isset($point->order_amount)?$point->order_amount:''}}">
                                @error('order_amount')
                                <div class="text-danger">{{ $errors->first('order_amount') }}</div>
                                @enderror
                            </div>
               
                        </div>
                        <br>

                        <div class="border  p-3">
                    
                            <div class="form-group">
                                <label for="order_points">@lang('main.order_points') </label>
                                <input type="number" name="order_points" class="form-control" id="order_points" placeholder="@lang('plachoder.enter_order_amount')" value="{{isset($point->order_points)?$point->order_points:''}}">
                                @error('order_points')
                                <div class="text-danger">{{ $errors->first('order_points') }}</div>
                                @enderror
                            </div>
               
                        </div>
                        <br>


                        







                    </div>



                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> @lang('main.update')</button>
                    </div>


                </form>
            </div>

        </div>
    </section>
@endsection


