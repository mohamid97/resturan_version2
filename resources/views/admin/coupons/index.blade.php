@extends('admin.layout.master')
@section('styles')
<style>
    svg{
        width: 15px !important;
    }
    nav{
        margin-top: 30px;
    }
    a{
        margin-bottom: 10px;
       display: inline-block;
    }
</style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.coupons') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.coupons')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div>

                <a href="{{route('admin.coupons.add')}}" style="color: #FFF">
                    <button class="btn btn-info" >
                        <i class="nav-icon fas fa-plus"></i>  @lang('sidebar.add_coupon')
                    </button>
                </a>

            </div>
            <br>
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title"> @lang('sidebar.all_coupons')</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>   @lang('main.photo')</th>
                            <th>   @lang('main.name') </th>
                            <th>   @lang('main.code') </th>
                            <th>   @lang('main.percentage') </th>
                            <th>   @lang('main.start_date')</th>
                            <th>  @lang('main.end_date')</th>
                            <th> @lang('main.action')</th></th>

                        </tr>
                        </thead>
                        <tbody>

                        @forelse($coupons as $index => $coupon)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{asset('uploads/images/coupons/'. $coupon->image)}}" width="150px" height="150px">
                                </td>
                                <td>{{ $coupon->name }}</td>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->percentage }}</td>
                                <td>{{ $coupon->start_date }}</td>
                                <td>{{ $coupon->end_date }}</td>


                                <td>
                                    <a href="{{route('admin.coupons.edit' ,  ['id' => $coupon->id])}}">
                                        <button class="btn btn-sm btn-info"> <i class="nav-icon fas fa-edit"></i>  @lang('main.edit')</th></button>
                                    </a>

                                    @if($coupon->deleted_at == null)

                                        <a href="{{route('admin.coupons.soft_delete' ,  ['id' => $coupon->id])}}">
                                            <button class="btn btn-sm btn-info"><i class="nav-icon fas fa-trash"></i>  @lang('main.soft_delete')</th></button>
                                        </a>
                                    @else
                                        <a href="{{route('admin.coupons.restore' ,  ['id' => $coupon->id])}}">
                                            <button class="btn btn-sm btn-info"><i class="nav-icon fas fa-trash-restore"></i>  @lang('main.restore')</th></button>
                                        </a>
                                    @endif

                                    <a href="{{route('admin.coupons.destroy' ,  ['id' => $coupon->id])}}">
                                        <button class="btn btn-sm btn-danger"><i class="nav-icon fas fa-trash"></i>  @lang('main.remove')</th></button>
                                    </a>

                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">  @lang('main.no_data')</th></td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                    <div>
                        {{ $coupons->links() }}
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
