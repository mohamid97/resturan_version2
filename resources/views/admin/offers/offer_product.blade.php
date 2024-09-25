@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Offer Product </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Offer Product</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <section class="content">
        <div class="container-fluid">
            <div>
                <form method="post" action="{{route('admin.offers.add_product' , ['id'=>$offer->id])}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label>Products</label>
                            <select type="text" name="product" class="form-control">
                                <option value="0">Select Products</option>
                                @forelse($products as $product)
                                
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @empty
                                @endforelse

                            </select>
                            @error('product')
                            <div class="text-danger">{{ $errors->first('product') }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-info" type="submit">
                            <i class="nav-icon fas fa-plus"></i> Add New Product
                        </button>

                </form>



            </div>
            <br>
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">Products</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row">

                        @forelse($offer->offer_products as $off)
                        @php
                            $product = \App\Models\Admin\Product::find($off->product_id);
                        @endphp
                        
                           
                         
                            <div class="col-md-12 col-lg-6 col-xl-4">
                                <div style="    border: 1px solid #CCC;
    padding: 7px 21px;margin-bottom: 20px;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="{{route('admin.offers.delete_product' , ['offer_id' => $offer->id , 'product_id'=> $product->id  ])}}" class="text-white">
                                                <button class="btn btn-sm btn-danger"><i class="nav-icon fas fa-trash"></i>  Delete </button>
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>{{ $product->name }}</h3>
                                        </div>

                                    </div>
                                    

                                </div>
                            </div> 

                        @empty
                           <p class="badge badge-danger"> No Product</p>
                        @endforelse



                    </div>





                </div>

            </div>

        </div>

    </section>
@endsection
