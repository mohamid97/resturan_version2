@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>  @lang('sidebar.des')  </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">  @lang('main.home') </a></li>
                        <li class="breadcrumb-item active">  @lang('sidebar.des') </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div>

                <a href="{{route('admin.des.add')}}" style="color: #FFF">
                    <button class="btn btn-info" >
                        <i class="nav-icon fas fa-plus"></i>   @lang('sidebar.add_new_des') 
                    </button>
                </a>
            </div>
            <br>
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.all_des') </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('main.name')</th>
                            <th>@lang('main.des')</th>
                            <th>@lang('main.photo')</th>
                            <th>@lang('main.action')</th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse($des as $de)
                            <tr>
                                <td>
                                    {{$de->id}}
                                </td>
                                <td>{{$de->translate($langs[0]->code)->name}}</td>
                                <td>{!! substr($de->translate($langs[0]->code)->des, 0,100)  !!} </td>
                                <td>
                                    @if ($de->image && $de->image != null)
                                    <img src="{{asset('uploads/images/des/'. $de->image)}}" width="90" height="90" />
                                    @else
                                    <span class="badge badge-danger"> @lang('main.no_image')</span>

                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('admin.des.edit' ,  ['id' => $de->id])}}">
                                        <button class="btn btn-sm btn-info"> <i class="nav-icon fas fa-edit"></i> @lang('main.edit')</button>
                                    </a>

                                    @if($de->deleted_at == null)

                                        <a href="{{route('admin.des.soft_delete' ,  ['id' => $de->id])}}">
                                            <button class="btn btn-sm btn-info"><i class="nav-icon fas fa-trash"></i> @lang('main.soft_delete') </button>
                                        </a>
                                    @else
                                        <a href="{{route('admin.des.restore' ,  ['id' => $de->id])}}">
                                            <button class="btn btn-sm btn-success"><i class="nav-icon fas fa-trash-restore"></i> @lang('main.restore')</button>
                                        </a>
                                    @endif
                                    <a href="{{route('admin.des.destroy' ,  ['id' => $de->id])}}">
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
