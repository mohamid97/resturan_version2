@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> @lang('sidebar.extras') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.combos')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div>

                <a href="{{route('admin.combo.create')}}" style="color: #FFF">
                    <button class="btn btn-info" >
                        <i class="nav-icon fas fa-plus"></i> @lang('sidebar.add_new_combo')
                    </button>
                </a>

            </div>
            <br>
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title"> @lang('sidebar.all_combos')</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('main.photo')</th>
                            <th> @lang('main.name')</th>
                            <th> @lang('main.price')</th>
                            <th> @lang('main.des')</th>
                            <th> @lang('main.action')</th>

                        </tr>
                        </thead>
                        <tbody>

                        @forelse($combos as $index => $combo)
                            <tr>
                                <td>{{$index + 1 }}</td>
                                <td>
                                    <img src="{{asset('uploads/images/combos/'. $combo->photo)}}" width="150px" height="150px">
                                </td>
                                <td>{{ isset($combo->translate(app()->getLocale())->name) ? $combo->translate(app()->getLocale())->name :'' }}</td>
                                <td>{{ isset($combo->price) ? $combo->price :'' }}</td>
                                <td>{!!   isset($combo->translate(app()->getLocale())->des) ? $combo->translate(app()->getLocale())->des :'' !!}</td>
                          

                                <td>
                                    <a href="{{route('admin.combo.edit' ,  ['id' => $combo->id])}}">
                                        <button class="btn btn-sm btn-info"> <i class="nav-icon fas fa-edit"></i>  @lang('main.edit')</button>
                                    </a>

                                    <a href="{{route('admin.combo.delete' ,  ['id' => $combo->id])}}">
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
