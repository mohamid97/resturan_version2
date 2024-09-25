@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.types') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.options')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <p class="alert alert-primary text-center">{{ $type->translate(app()->getLocale())->name  }} / {{ $type->small_des }} </p>
            <br>
            <p>
            <a href="{{route('admin.types.type_option.create')}}" style="color: #FFF">
                <button class="btn btn-info" >
                    <i class="nav-icon fas fa-plus"></i> @lang('sidebar.add_new_type_option')
                </button>
            </a>
            </p>
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title"> @lang('sidebar.all_types')</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> @lang('main.name')</th>
                            <th> @lang('main.des')</th>
                            <th> @lang('main.action')</th>

                        </tr>
                        </thead>
                        <tbody>

                        @forelse($type->options as $index => $option)
                            <tr>
                                <td>{{$index + 1 }}</td>
                                <td>{{ isset($option->translate(app()->getLocale())->name) ? $option->translate(app()->getLocale())->name :'' }}</td>
                                <td>{!!   isset($option->translate(app()->getLocale())->des) ? $option->translate(app()->getLocale())->des :'' !!}</td>
                          

                                <td>

                                    <a href="{{route('admin.types.type_options.delete' ,  ['id' => $option->id])}}">
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
