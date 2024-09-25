@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> @lang('sidebar.offers') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> @lang('sidebar.offers')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div>

                <a href="{{route('admin.offers.add')}}" style="color: #FFF">
                    <button class="btn btn-info" >
                        <i class="nav-icon fas fa-plus"></i>  @lang('sidebar.add_new_offer')
                    </button>
                </a>

            </div>
            <br>
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.all_offers')</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>

                            @foreach($langs as $lang)
                                <th>@lang('main.title') ({{$lang->code}})</th>
                            @endforeach

                            <th>@lang('main.action')</th>

                        </tr>
                        </thead>
                        <tbody>

                        @forelse($offers as $index => $offer)
                            <tr>
                                <td>{{$index + 1 }}</td>

                                @foreach($langs as $lang)
                                    <td>{{isset($offer->translate($lang->code)->title) ? $offer->translate($lang->code)->title :''}}</td>
                                @endforeach


                                <td>
                                    <a href="{{route('admin.offers.edit' ,  ['id' => $offer->id])}}">
                                        <button class="btn btn-sm btn-info"> <i class="nav-icon fas fa-edit"></i> @lang('main.edit')</button>
                                    </a>

                                    @if($offer->deleted_at == null)

                                        <a href="{{route('admin.offers.soft_delete' ,  ['id' => $offer->id])}}">
                                            <button class="btn btn-sm btn-info"><i class="nav-icon fas fa-trash"></i> @lang('main.soft_delete')</button>
                                        </a>
                                    @else
                                        <a href="{{route('admin.offers.restore' ,  ['id' => $offer->id])}}">
                                            <button class="btn btn-sm btn-info"><i class="nav-icon fas fa-trash-restore"></i> @lang('main.restore')</button>
                                        </a>
                                    @endif


                                    <a href="{{route('admin.offers.show_product' ,  ['id' => $offer->id])}}">
                                        <button class="btn btn-sm btn-success"> <i class="nav-icon fas fa-edit"></i> @lang('sidebar.show_products')</button>
                                    </a>





                                    <a href="{{route('admin.offers.destroy' ,  ['id' => $offer->id])}}">
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
