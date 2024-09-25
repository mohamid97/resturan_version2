@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.categories') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.categories')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div>

                <a href="{{route('admin.category.add')}}" style="color: #FFF">
                    <button class="btn btn-info" >
                        <i class="nav-icon fas fa-plus"></i> @lang('sidebar.add_new_category')
                    </button>
                </a>

            </div>
            <br>
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.all_categories')</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('main.photo')</th>
                             @foreach($langs as $lang)
                                 <th>@lang('main.name') ({{$lang->code}})</th>
                             @endforeach
                            <th>@lang('main.type')</th>
                            <th>@lang('main.action')</th>

                        </tr>
                        </thead>
                        <tbody>

                        @forelse($categories as $cat)
                            <tr>
                                <td>{{$cat->id}}</td>
                                <td>
                                    <img src="{{asset('uploads/images/category/'. $cat->photo)}}" width="150px" height="150px">
                                </td>
                                @foreach($langs as $lang)
                                <td>{{(isset($cat->translate($lang->code)->name) ? $cat->translate($lang->code)->name : '')}}</td>
                                @endforeach
                                <td>
                                    @if($cat->type == 0)
                                         <span class="badge badge-danger">@lang('main.parent')</span>
                                    @else
                                        <span class="badge badge-primary"> @lang('main.child') </span>

                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('admin.category.edit' ,  ['id' => $cat->id])}}">
                                        <button class="btn btn-sm btn-info"> <i class="nav-icon fas fa-edit"></i> @lang('main.edit')</button>
                                    </a>

                                    @if($cat->deleted_at == null)

                                        <a href="{{route('admin.category.soft_delete' ,  ['id' => $cat->id])}}">
                                            <button class="btn btn-sm btn-info"><i class="nav-icon fas fa-trash"></i> @lang('main.soft_delete') </button>
                                        </a>
                                    @else
                                        <a href="{{route('admin.category.restore' ,  ['id' => $cat->id])}}">
                                            <button class="btn btn-sm btn-info"><i class="nav-icon fas fa-trash-restore"></i> @lang('main.restore')</button>
                                        </a>
                                    @endif





                                    <a href="{{route('admin.category.destroy' ,  ['id' => $cat->id])}}">
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
