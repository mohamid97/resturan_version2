@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.branches') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.branches')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div>

                <a href="{{route('admin.branches.create')}}" style="color: #FFF">
                    <button class="btn btn-info" >
                        <i class="nav-icon fas fa-plus"></i> @lang('sidebar.add_new_branch')
                    </button>
                </a>



            </div>
            <br>
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title"> @lang('sidebar.all_branch')</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> @lang('main.name')</th>
                            <th> @lang('main.location')</th>
                            <th> @lang('main.phone1')</th>
                            <th> @lang('main.phone2')</th>
                            <th> @lang('main.whatsup')</th>
                            <th> @lang('main.action')</th>

                        </tr>
                        </thead>
                        <tbody>

                        @forelse($branchs as $index => $branch)
                            <tr>
                                <td>{{$index + 1 }}</td>
                                <td>{{ isset($branch->translate(app()->getLocale())->name) ? $branch->translate(app()->getLocale())->name :'' }}</td>
                                
                                <td>{{   isset($branch->location) ? $branch->location :'' }}</td>
                                <td>{{ isset($branch->phone1) ? $branch->phone1 :'' }}</td>
                                <td>{{ isset($branch->phone2) ? $branch->phone2 :'' }}</td>
                                <td>{{ isset($branch->whatsup) ? $branch->whatsup :'' }}</td>
                                <td>

                                    <a href="{{route('admin.branches.edit' ,  ['id' => $branch->id])}}">
                                        <button class="btn btn-sm btn-info"> <i class="nav-icon fas fa-edit"></i>  @lang('main.edit')</button>
                                    </a>

                                    <a href="{{route('admin.cms.destroy' ,  ['id' => $branch->id])}}">
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
