@extends('admin.layout.master')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.show_messages')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.show_messages')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"> {{isset($msg->name) ?  $msg->name :'' }} {{isset($msg->subject) ? '-' . $msg->subject :'' }} {{'-'.$msg->phone}}</h3>
                </div>
            </div>
        </div>
        <div class="text-right p-4" style="line-height: 2">
            <p>{{$msg->message}}</p>

            <button class="btn btn-danger ms-auto">
                <a href="" style="color: #FFF;" > <i class="nav-icon fas fa-trash"></i>  @lang('main.remove')</a>
            </button>
        </div>

    </section>




@endsection
