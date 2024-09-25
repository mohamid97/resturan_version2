@extends('admin.layout.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('sidebar.all_carts') </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">@lang('main.home') </a></li>
                    <li class="breadcrumb-item active">@lang('sidebar.carts') </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">

        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">@lang('sidebar.all_carts') </h3>

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
                        <th>@lang('main.action')</th>

                    </tr>
                    </thead>
                    <tbody>

                    @forelse($carts as $index => $cart)
            
                        <tr>
                            <td>{{ $index + 1  }} </td>
                            <td>{{$cart->user->first_name }}</td>
                            <td>{{$cart->user->last_name }}</td>
                            <td>{{$cart->items->sum('quantity') }}</td>
                            <td>
                                <a href="{{route('admin.carts.delete' ,  ['id' => $cart->id])}}">
                                    <button class="btn btn-sm btn-danger"><i class="nav-icon fas fa-trash"></i> @lang('main.remove')</button>
                                </a>


                                <a href="{{route('admin.carts.show_details' ,  ['id' => $cart->id])}}">
                                    <button class="btn btn-sm btn-primary"><i class="nav-icon fas fa-eye"></i> @lang('main.show')</button>
                                </a>

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
        {{ $carts->links() }}
    </div>

            </div>

        </div>
    </div>
</section>
@endsection