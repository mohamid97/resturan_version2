@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.features')  </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home') </a></li>
                        <li class="breadcrumb-item active">@lang('main.features') </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <section class="content">
        <div class="container-fluid">
            <div>
                <form method="post" action="{{route('admin.featured.store')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                            <label>Products</label>
                            <select type="text" name="product_id" class="form-control">
                                <option value="0">@lang('main.select_product')</option>
                                @forelse($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @empty
                                @endforelse

                            </select>
                            @error('product_id')
                            <div class="text-danger">{{ $errors->first('product_id') }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-info" type="submit">
                            <i class="nav-icon fas fa-plus"></i> @lang('main.add_new_product')  
                        </button>

                </form>

            </div>
            <br>
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">@lang('main.featured')  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row">

                        @forelse($features as $fe)
                            <div class="col-md-12 col-lg-6 col-xl-4">
                                <div class="card mb-2 bg-gradient-dark">
                                    <p>{{ $fe->product->name }}</p>
                                    <a href="{{route('admin.featured.delete' , ['id' => $fe->id])}}" class="text-white">
                                        <button class="btn btn-sm btn-danger"><i class="nav-icon fas fa-trash"></i>@lang('main.delete')</button>
                                    </a>
                                </div>
                            </div>
                        @empty
                           <p class="badge badge-danger"> @lang('main.featured') </p>
                        @endforelse



                    </div>





                </div>

            </div>

        </div>

    </section>
@endsection
