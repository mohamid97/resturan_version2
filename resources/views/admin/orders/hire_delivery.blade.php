@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.hire_delivery')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('main.delivery') </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('main.delivery')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.orders.hire_order_submit' , ['id'=>$order->id])}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">

                        <div class="form-group">
                            <label>Delivery --  {{ isset($delivery_man) && isset($delivery_man->user) ? 'hired by :' . $delivery_man->user->first_name :'' }}</label>
                            <select type="text" name="delivery_id" class="form-control">
                                <option value="0">@lang('main.select_delivery')</option>
                                @forelse($delivery as $del)
                                    <option value="{{$del->id}}">{{ $del->first_name}}  {{ $del->last_name_name }} ---  {{ $del->phone }}</option>
                                @empty
                                  <option value="" disabled> No Delivery Are Available</option>
                                @endforelse

                            </select>
                            @error('delivery_id')
                            <div class="text-danger">{{ $errors->first('delivery_id') }}</div>
                            @enderror
                        </div>




                    </div>



                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> @lang('main.submit')</button>
                    </div>


                </form>
            </div>

        </div>
    </section>
@endsection
