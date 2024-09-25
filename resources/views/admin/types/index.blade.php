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
                        <li class="breadcrumb-item active">@lang('sidebar.types')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div>

                <a href="{{route('admin.types.create')}}" style="color: #FFF">
                    <button class="btn btn-info" >
                        <i class="nav-icon fas fa-plus"></i> @lang('sidebar.add_new_type')
                    </button>
                </a>


                <a href="{{route('admin.types.type_option.create')}}" style="color: #FFF">
                    <button class="btn btn-info" >
                        <i class="nav-icon fas fa-plus"></i> @lang('sidebar.add_new_type_option')
                    </button>
                </a>

            </div>
            <br>
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
                            <th> @lang('main.small_des')</th>
                            <th> @lang('main.action')</th>

                        </tr>
                        </thead>
                        <tbody>

                        @forelse($types as $index => $type)
                            <tr>
                                <td>{{$index + 1 }}</td>
                                <td>{{ isset($type->translate(app()->getLocale())->name) ? $type->translate(app()->getLocale())->name :'' }}</td>
                                <td>{{ isset($type->small_des) ? $type->small_des :'' }}</td>
                                <td>{!!   isset($type->translate(app()->getLocale())->des) ? $type->translate(app()->getLocale())->des :'' !!}</td>
                          

                                <td>
                                    <a href="{{route('admin.types.edit' ,  ['id' => $type->id])}}">
                                        <button class="btn btn-sm btn-info"> <i class="nav-icon fas fa-edit"></i>  @lang('main.edit')</button>
                                    </a>

                                    <a href="{{route('admin.types.delete' ,  ['id' => $type->id])}}">
                                        <button class="btn btn-sm btn-danger"><i class="nav-icon fas fa-trash"></i> @lang('main.remove')</button>
                                    </a>

                                    <a href="{{route('admin.types.show_options' ,  ['id' => $type->id])}}">
                                        <button class="btn btn-sm btn-primary"><i class="nav-icon fas fa-trash"></i> @lang('main.show')</button>
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
