@extends('admin.layout.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('sidebar.all_orders')  </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">@lang('main.home') </a></li>
                    <li class="breadcrumb-item active">@lang('sidebar.orders') </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">

        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">@lang('sidebar.all_orders') </h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('main.first_name') </th>
                        <th>@lang('main.last_name')</th>
                        <th>@lang('main.quntity')</th>
                        <th>@lang('main.status')</th>
                        <th>@lang('main.payment_status')</th>
                        <th>@lang('main.payment_method')</th>
                        <th>@lang('main.action')</th>

                    </tr>
                    </thead>
                    <tbody>

                    @forelse($orders as $index => $order)
        
                        <tr>
                            <td>{{ $index + 1  }} </td>
                            <td>{{ optional($order->address)->first_name }}</td>
                            <td>{{optional($order->address)->first_name }}</td>
                            <td>{{$order->items->sum('quantity') }}</td>
                            <td>
                             @if ($order->status == 'pending')
                               <span class="badge badge-primary">@lang('main.pending')</span>
                             @elseif ($order->status == 'proceed')
                               <span class="badge badge-info"> @lang('main.proceed')</span>
                             @elseif ($order->status == 'on way')
                               <span class="badge badge-warning">@lang('main.on_way')</span>
                            @elseif ($order->status == 'finshed')
                               <span class="badge badge-success">@lang('main.finished')</span>
                            @elseif ($order->status == 'canceled')
                            <span class="badge badge-danger">@lang('main.canceled')</span>
                             @endif   
                            </td>

                            <td>
                                @if ($order->payment_status == 'paid')
                                  <span class="badge badge-success">@lang('main.paid')</span>
                                @elseif ($order->payment_status == 'unpaid')
                                  <span class="badge badge-danger">@lang('main.unpaid')</span>
                                @endif   
                               </td>
                          

                            <td>
                                @if ($order->payment_method == 'cash')
                                    <span class="badge badge-success">@lang('main.cahs')</span>
                                @elseif ($order->payment_method == 'paymob')
                                <span class="badge badge-success">@lang('main.paymob')</span>
                                @elseif ($order->payment_method == 'other')
                                <span class="badge badge-success">@lang('main.other')</span>
                                @elseif ($order->payment_method == 'paypal')
                                <span class="badge badge-success">@lang('main.paypal')</span>
                                @endif   
                            </td>
                            <td>
                                <a href="{{route('admin.orders.delete' ,  ['id' => $order->id])}}">
                                    <button class="btn btn-sm btn-danger"><i class="nav-icon fas fa-trash"></i> @lang('main.remove')</button>
                                </a>


                                <a href="{{route('admin.orders.show_details' ,  ['id' => $order->id])}}">
                                    <button class="btn btn-sm btn-primary"><i class="nav-icon fas fa-eye"></i> @lang('main.show')</button>
                                </a>

                           
                                 <a href="{{route('admin.orders.edit_status' ,  ['id' => $order->id])}}">
                                    <button class="btn btn-sm btn-primary"><i class="nav-icon fas fa-eye"></i> @lang('main.edit_status')</button>
                                </a>
                                     
                           


                                @if ($order->status == 'on way')
                                
                                    <a href="{{route('admin.orders.hire_delivery' ,  ['id' => $order->id])}}">
                                        <button class="btn btn-sm btn-success"><i class=" fas fa-solid fa-truck"></i>  @lang('main.hire_delivery')</button>
                                    </a>
                                @endif 
                            </td>

                        </tr>
                    @empty
                            <tr>
                                <td colspan="3"> @lang('main.no_data')</td>
                            </tr>
                    @endforelse


                    </tbody>
                </table>

                    <!-- Pagination Links -->
    <div>
        {{ $orders->links() }}
    </div>

            </div>

        </div>
    </div>
</section>
@endsection