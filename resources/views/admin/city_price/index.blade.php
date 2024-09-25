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
                    <h1>@lang('sidebar.city_price') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">@lang('main.home') </a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.city_price') </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.all_city_price')</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('sidebar.gov_arabic') </th>
                            <th>@lang('sidebar.gov_english')</th>
                            <th>@lang('sidebar.city_arabic')</th>
                            <th>@lang('sidebar.city_english')</th>
                            <th>@lang('main.price')</th>
                            <th>@lang('main.action')</th>

                        </tr>
                        </thead>
                        <tbody>

                        @forelse($cities as $index => $city)
                            <tr>
                                <td>{{ $index +1  }} </td>
                                <td>{{ $city->gov->translate('ar')->name }}</td>
                                <td>{{ $city->gov->translate('en')->name }}</td>
                                <td>{{ $city->translate('ar')->name }}</td>
                                <td>{{ $city->translate('en')->name }}</td>
                                <td>{{ isset( $city->price->price) ?  $city->price->price : 0 }}</td>

                                <td>
                                    <a href="{{route('admin.city.edit' ,  ['id' => $city->id])}}">
                                        <button class="btn btn-sm btn-info"> <i class="nav-icon fas fa-edit"></i> Edit</button>
                                    </a>

                                </td>

                            </tr>
                        @empty
                                <tr>
                                    <td colspan="3"> No Data</td>
                                </tr>
                        @endforelse


                        </tbody>
                    </table>
                        <!-- Pagination Links -->
                        {{ $cities->links() }}
                </div>

            </div>
        </div>
    </section>

@endsection
