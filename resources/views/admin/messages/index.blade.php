@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.message_from_contact')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.messages')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.all_messages')</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('main.name')</th>
                            <th>@lang('main.phone')</th>
                            <th>@lang('main.email')</th>
                            <th>@lang('main.subject')</th>
                            <th>@lang('main.action')</th>

                        </tr>
                        </thead>
                        <tbody>

                        @forelse($msgs as $index => $msg)
                            <tr>
                                <td>{{ $index + 1  }}</td>
                                <td>
                                    {{isset($msg->name) ? $msg->name : 'No Data'}}
                                </td>
                                <td>
                                    {{isset($msg->phone) ? $msg->phone : 'No Data'}}
                                </td>

                                <td>
                                    {{isset($msg->email) ? $msg->email : 'No Data'}}
                                </td>

                                <td>
                                    {{isset($msg->subject) ? $msg->subject : 'No Data'}}
                                </td>
                                <td>
                                    <a href="{{route('admin.messages.show' ,  ['id' => $msg->id])}}">
                                        <button class="btn btn-sm btn-info"> <i class="nav-icon fas fa-edit"></i> @lang('main.show')</button>
                                    </a>

                                    <a href="{{route('admin.messages.destroy' ,  ['id' => $msg->id])}}">
                                        <button class="btn btn-sm btn-danger"><i class="nav-icon fas fa-trash"></i> @lang('main.remove')</button>
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
                </div>

            </div>
        </div>
    </section>

@endsection
