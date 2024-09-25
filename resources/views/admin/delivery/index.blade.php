@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> @lang('sidebar.delivery') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"> @lang('main.home')</a></li>
                        <li class="breadcrumb-item active"> @lang('sidebar.delivery')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <br>
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.all_delivery') </h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('main.avatar')</th>
                            <th>@lang('main.name')</th>
                            <th>@lang('main.email')</th>
                            <th>@lang('main.phone')</th>
                            <th>@lang('main.action')</th>

                        </tr>
                        </thead>
                        <tbody>

                        @forelse($accounts as $index => $account)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{asset('uploads/images/delivery/'. $account->avatar)}}" width="150px" height="150px">
                                </td>
                                <td>{{$account->first_name}} {{ $account->last_name }}</td>
                                <td>{{$account->email}} </td>
                                <td>{{$account->phone}} </td>
                                <td>
                                    <a href="{{route('admin.delivery.edit' ,  ['id' => $account->id])}}">
                                        <button class="btn btn-sm btn-info"> <i class="nav-icon fas fa-edit"></i> @lang('main.edit')</button>
                                    </a>


                                    <a href="{{route('admin.delivery.destroy' ,  ['id' => $account->id])}}">
                                        <button class="btn btn-sm btn-danger"><i class="nav-icon fas fa-trash"></i> @lang('main.remove')</button>
                                    </a>

                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">@lang('main.no_data')</td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>

@endsection
