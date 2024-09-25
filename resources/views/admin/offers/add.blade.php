@extends('admin.layout.master')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> @lang('sidebar.add_offer')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"> @lang('main.home')</a></li>
                        <li class="breadcrumb-item active"> @lang('sidebar.add_offer')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.offers')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.offers.store') }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">


                        @foreach($langs as $lang)
                            <div class="form-group">
                                <label for="title">@lang('main.title') ({{ $lang->name }}) </label>
                                <input type="text" name="title[{{$lang->code}}]" class="form-control" id="title" placeholder="@lang('plachoder.enter_title')" value="{{ old('title.' . $lang->code) }}">
                                @error('title.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('title.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach


                        <div class="form-group">
                            <label for="image">@lang('main.image')</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="image" type="file" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">Choose Image</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">@lang('main.upload')</span>
                                </div>
                            </div>

                            @error('image')
                            <div class="text-danger">{{ $errors->first('image') }}</div>
                            @enderror
                        </div>


                         <div class="form-group">
                                <label for="price">@lang('main.price')  </label>
                                <input type="text" name="price" class="form-control" id="price" placeholder="@lang('plachoder.enter_price')" value="{{ old('price') }}">
                                @error('price')
                                <div class="text-danger">{{ $errors->first('price') }}</div>
                                @enderror
                         </div>


                         <div class="form-group">
                            <label for="old_price">@lang('main.old_price')</label>
                            <input type="text" name="old_price" class="form-control" id="old_price" placeholder="@lang('plachoder.enter_old_price')" value="{{ old('old_price') }}">
                            @error('old_price')
                            <div class="text-danger">{{ $errors->first('old_price') }}</div>
                            @enderror
                        </div>



                        @foreach($langs as $index => $lang)


                            <div class="form-group">
                                <label for="small_des">@lang('main.small_des') ({{$lang->name}})</label>
                                <input  id="small_des" class="form-control" name="small_des[{{$lang->code}}]" placeholder="@lang('plachoder.enter_small_des')">
                                @error('small_des.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('small_des.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach






                        @foreach($langs as $index => $lang)


                            <div class="form-group">
                                <label for="des">@lang('main.des') ({{$lang->name}})</label>
                                <textarea name="des[{{$lang->code}}]" class="ckeditor">

                               </textarea>

                                @error('des.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('des.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach






                        <div class="form-group">
                            <label>@lang('sidebar.products') </label>
                            <select type="text" name="products[]" class="form-control" multiple>
                                <option value="0">@lang('plachoder.select_products')</option>
                                @forelse($products as $product)
                                
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @empty
                                @endforelse

                            </select>
                            @error('products')
                            <div class="text-danger">{{ $errors->first('products') }}</div>
                            @enderror
                        </div>






                    </div>



                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> @lang('main.submit')</button>
                    </div>


                </form>
            </div>

        </div>
    </section>
@endsection

