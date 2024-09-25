@extends('admin.layout.master')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.our_work') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.our_work')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div>

                <a href="{{route('admin.our_works.add')}}" style="color: #FFF">
                    <button class="btn btn-info" >
                        <i class="nav-icon fas fa-plus"></i> @lang('sidebar.add_new_work')
                    </button>
                </a>

            </div>
            <br>
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.our_work')</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            @foreach($langs as $lang)
                                <td>@lang('main.name') ( {{$lang->code}} ) </td>
                            @endforeach
                            <th>@lang('main.photo')</th>
                            <th>@lang('main.icon')</th>
                            <th>@lang('main.link')</th>
                            <th>@lang('main.action')</th>

                        </tr>
                        </thead>
                        <tbody>

                        @forelse($our_works as $index => $work)
                            <tr>
                                <td>{{$index + 1}}</td>
                                @foreach($langs as $lang)
                                    <td>{{isset($work->translate($lang->code)->name) ? $work->translate($lang->code)->name :''}}</td>
                                @endforeach
                                <td>
                                    <img src="{{asset('uploads/images/ourworks/'. $work->photo)}}" width="150px" height="150px">
                                </td>
                                <td>
                                    <img src="{{asset('uploads/images/ourworks/'. $work->icon)}}" width="150px" height="150px">
                                </td>

                                <td>{{$work->link}} </td>
                                <td>
                                    <a href="{{route('admin.our_works.edit' ,  ['id' => $work->id])}}">
                                        <button class="btn btn-sm btn-info"> <i class="nav-icon fas fa-edit"></i> @lang('main.edit')</button>
                                    </a>

                                    @if($work->deleted_at == null)

                                        <a href="{{route('admin.our_works.soft_delete' ,  ['id' => $work->id])}}">
                                            <button class="btn btn-sm btn-info"><i class="nav-icon fas fa-trash"></i> @lang('main.soft_delete')</button>
                                        </a>
                                    @else
                                        <a href="{{route('admin.our_works.restore' ,  ['id' => $work->id])}}">
                                            <button class="btn btn-sm btn-info"><i class="nav-icon fas fa-trash-restore"></i> @lang('main.restore')</button>
                                        </a>
                                    @endif


                                    <a href="{{route('admin.our_works.destroy' ,  ['id' => $work->id])}}">
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
