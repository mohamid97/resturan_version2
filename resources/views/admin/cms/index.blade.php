@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> @lang('sidebar.blog') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}"> @lang('main.home')</a></li>
                        <li class="breadcrumb-item active"> @lang('sidebar.blog')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div>

                    <a href="{{route('admin.cms.add')}}" style="color: #FFF">
                        <button class="btn btn-info" >
                            <i class="nav-icon fas fa-plus"></i>  @lang('sidebar.add_new_article')
                        </button>
                    </a>

            </div>
            <br>
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.all_articles')</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('main.image')</th>
                            <th>@lang('main.title')</th>
                            <th>@lang('main.slug')</th>
                            <th>@lang('main.action')</th>

                        </tr>
                        </thead>
                        <tbody>

                        @forelse($cms as $index => $blog)
                            <tr>
                                <td>{{ $index +1  }} </td>
                                <td>
                                    <img src="{{asset('uploads/images/cms/'. $blog->image)}}" width="150px" height="150px">
                                </td>
                                <td>{{ $blog->translate(app()->getLocale())->name }}</td>
                                <td>{{ $blog->translate(app()->getLocale())->slug }}</td>
                                <td>
                                    <a href="{{route('admin.cms.edit' ,  ['id' => $blog->id])}}">
                                        <button class="btn btn-sm btn-info"> <i class="nav-icon fas fa-edit"></i> @lang('main.edit')</button>
                                    </a>

                                    @if($blog->deleted_at == null)

                                        <a href="{{route('admin.cms.soft_delete' ,  ['id' => $blog->id])}}">
                                            <button class="btn btn-sm btn-info"><i class="nav-icon fas fa-trash"></i> @lang('main.soft_delete') </button>
                                        </a>
                                    @else
                                        <a href="{{route('admin.cms.restore' ,  ['id' => $blog->id])}}">
                                            <button class="btn btn-sm btn-success"><i class="nav-icon fas fa-trash-restore"></i> @lang('main.restore')</button>
                                        </a>
                                    @endif


                                    <a href="{{route('admin.cms.destroy' ,  ['id' => $blog->id])}}">
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
