@extends('admin.layout.master')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.add_extra_to_product')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.add_extra_to_product') </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
    

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.products')</h3>
                   
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.products.store_extra') }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">


                     <input type="hidden" name="product_id" value="{{ $product_id }}" type="text"/>

                        <div class="form-group">
                            <label>Types</label>
                            <select type="text" name="extra_id" class="form-control">
                                <option value="0">@lang('main.select_extra')</option>
                                @forelse($extras as $extra)
                                    <option value="{{$extra->id}}">{{$extra->translate(app()->getLocale())->name}} </option>
                                @empty
                                @endforelse

                            </select>
                            @error('extra_id')
                            <div class="text-danger">{{ $errors->first('extra_id') }}</div>
                            @enderror
                        </div>





                    </div>



                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> @lang('main.submit')</button>
                    </div>


                </form>
            </div>



            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Product Extras</h3>
                </div>
                
                <div class="card-body">
                <table class="table table-bordered">
                <thead>
                <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Price </th>
                <th>Action</th>
                

                </tr>
                </thead>
                <tbody>

                @foreach ($product_extras as $index =>$extra)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $extra->name}}</td>
                        <td>{{ $extra->price }}</td>
                        <td>
                            <a href="{{route('admin.product_extra.destroy_extra' ,  ['product_id'=> $product_id, 'extra_id' => $extra->id])}}">
                                <button class="btn btn-sm btn-danger"><i class="nav-icon fas fa-trash"></i> @lang('main.remove')</button>
                            </a>
                        </td>
                    </tr>
                @endforeach


                </tbody>
                </table>
                </div>
                

                </div>




        </div>
    </section>
@endsection

