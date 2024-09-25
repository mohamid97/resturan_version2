@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Status Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Update Status </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Update Status</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.order.update_status' , ['id' => $order->id]) }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">








                        <div class="form-group" >
                            <label>Type</label>
                            <select type="text" name="status" class="form-control" id="type">
                                <option value="pending" {{$order->status == 'pending' ?'selected':''}}>pending</option>
                                <option value="proceed" {{$order->status == 'proceed' ?'selected':''}}>proceed</option>

                                <option value="on way" {{$order->status == 'on way' ?'selected':''}}>on way</option>
                                <option value="on way" {{$order->status == 'delivered' ?'selected':''}}> Delivered</option>
                                <option value="finshed" {{$order->status == 'finshed' ?'selected':''}}>finshed</option>

                                <option value="canceled" {{$order->status == 'canceled' ?'selected':''}}>canceled</option>

                            </select>
                            @error('status')
                            <div class="text-danger">{{ $errors->first('status') }}</div>
                            @enderror
                        </div>

                        <br>


                        <div class="form-group" >
                            <label>Type</label>
                            <select type="text" name="payment_status" class="form-control" id="type">
                                <option value="unpaid" {{$order->payment_status == 'unpaid' ?'selected':''}}>unpaid</option>
                                <option value="paid" {{$order->payment_status == 'paid' ?'selected':''}}>paid</option>

                            </select>
                            @error('payment_status')
                            <div class="text-danger">{{ $errors->first('payment_status') }}</div>
                            @enderror
                        </div>











                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> Submit</button>
                    </div>


                </form>
            </div>

        </div>
    </section>
@endsection


