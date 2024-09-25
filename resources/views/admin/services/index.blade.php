@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> @lang('sidebar.services') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"> @lang('main.home')</a></li>
                        <li class="breadcrumb-item active"> @lang('sidebar.services')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div>

                <a href="{{route('admin.services.add')}}" style="color: #FFF">
                    <button class="btn btn-info" >
                        <i class="nav-icon fas fa-plus"></i>  @lang('sidebar.add_new_service')
                    </button>
                </a>

            </div>
            <br>
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title"> @lang('sidebar.all_services')</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>

                            @foreach($langs as $lang)
                                <th> @lang('main.name') ({{$lang->code}})</th>
                            @endforeach
                            <th> @lang('main.image')</th>
                            <th> @lang('main.action')</th>

                        </tr>
                        </thead>
                        <tbody>

                        @forelse($services as $index => $service)
                            <tr>
                                <td>{{$index + 1}}</td>

                                @foreach($langs as $lang)
                                    <td>
    
                                        {{isset($service->translate($lang->code)->name)? $service->translate($lang->code)->name :''}}
                                    </td>
                                @endforeach
                                <td>
                            
                                    <img src="{{ asset('uploads/images/service/'.$service->image) }}" width="70px" height="70px">

                                </td>

                                <td>
                                    <a href="{{route('admin.services.edit' ,  ['id' => $service->id])}}">
                                        <button class="btn btn-sm btn-info"> <i class="nav-icon fas fa-edit"></i> @lang('main.edit')</button>
                                    </a>

                                    @if($service->deleted_at == null)

                                        <a href="{{route('admin.services.soft_delete' ,  ['id' => $service->id])}}">
                                            <button class="btn btn-sm btn-info"><i class="nav-icon fas fa-trash"></i> @lang('main.soft_delete')</button>
                                        </a>
                                    @else
                                        <a href="{{route('admin.services.restore' ,  ['id' => $service->id])}}">
                                            <button class="btn btn-sm btn-info"><i class="nav-icon fas fa-trash-restore"></i> @lang('main.restore')</button>
                                        </a>
                                    @endif


                                    <a href="{{route('admin.services.gallery' ,  ['id' => $service->id])}}">
                                        <button class="btn btn-sm btn-success"> <i class="nav-icon fas fa-edit"></i> @lang('main.show_gallery')</button>
                                    </a>





                                    <a href="{{route('admin.services.destroy' ,  ['id' => $service->id])}}">
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
