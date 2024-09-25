@extends('admin.layout.master')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.edit_service') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home') <</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.edit_service') < </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.services') <</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.services.update' , ['id'=>$service->id]) }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">

                        <div class="border  p-3">

                        @foreach($langs as $lang)
                            <div class="form-group">
                                <label for="name">@lang('main.name')  ({{ $lang->name }}) </label>
                                <input type="text" name="name[{{$lang->code}}]" class="form-control" id="name" placeholder="@lang('plachoder.enter_name') " value="{{ isset($service->translate($lang->code)->name) ? $service->translate($lang->code)->name :'' }}">
                                @error('name.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('name.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach
                        </div>
                        <br>



                        <div class="border  p-3">

                            @foreach($langs as $lang)
                                <div class="form-group">
                                    <label for="slug">@lang('main.slug')  ({{ $lang->name }}) </label>
                                    <input type="text" name="slug[{{$lang->code}}]" class="form-control" id="slug" placeholder="@lang('plachoder.enter_slug') " value="{{ isset($service->translate($lang->code)->slug) ? $service->translate($lang->code)->slug : '' }}">
                                    @error('slug.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('slug.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                            </div>
                            <br>



                            <div class="form-group">
                                <label for="price">@lang('main.price')  ({{ $lang->name }}) </label>
                                <input type="text" name="price" class="form-control" id="price" placeholder="@lang('plachoder.enter_price') " value="{{ $service->price }}">
                                @error('price')
                                <div class="text-danger">{{ $errors->first('price') }}</div>
                                @enderror
                            </div>



                        @foreach($langs as $index => $lang)


                            <div class="form-group">
                                <label for="image">@lang('main.des')  ({{$lang->name}})</label>
                                <textarea name="des[{{$lang->code}}]" class="ckeditor">

                                    @if (isset($service->translate($lang->code)->des))
                                    {!! $service->translate($lang->code)->des !!}
                                    @endif
                                    
                                </textarea>

                                @error('des.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('des.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach




                        @foreach($langs as $index => $lang)

                            <div class="form-group">
                                <label for="meta_title">@lang('main.meta_title')   ({{$lang->name}})</label>
                                <textarea name="meta_title[{{$lang->code}}]" class="ckeditor">
                                    @if (isset($service->translate($lang->code)->des))
                                    {!! $service->translate($lang->code)->meta_title !!}
                                    @endif
                                           
                                    </textarea>

                                @error('meta_title.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('meta_title.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach




                        @foreach($langs as $index => $lang)
                            <div class="form-group">
                                <label for="meta_des">@lang('main.meta_des')   ({{$lang->name}})</label>
                                <textarea name="meta_des[{{$lang->code}}]" class="ckeditor">
                                    @if (isset($service->translate($lang->code)->des))
                                       {!! $service->translate($lang->code)->meta_des !!}
                                    @endif
                                </textarea>

                                @error('meta_des.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('meta_des.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach



                        <div class="form-group">
                            <label for="image">@lang('main.photos') </label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="image" type="file" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">Choose Image</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">@lang('main.upload') </span>
                                </div>
                            </div>

                                <img src="{{asset('uploads/images/service/'.$service->image)}}" width="70px" height="70px">

                        </div>



                        <div class="border  p-3">
                            @foreach($langs as $lang)
                                <div class="form-group">
                                    <label for="alt_image">@lang('main.alt_image') ({{ $lang->name }}) </label>
                                    <input type="text" name="alt_image[{{$lang->code}}]" class="form-control" id="alt_image" placeholder="@lang('plachoder.enter_alt_image') " value=" {{ isset($service->translate($lang->code)->alt_image) ? $service->translate($lang->code)->alt_image :''}} ">
                                    @error('alt_image.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('alt_image.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                            </div>
                            <br>




                        <div class="border  p-3">
                            @foreach($langs as $lang)
                                <div class="form-group">
                                    <label for="title_image">@lang('main.title_image') ({{ $lang->name }}) </label>
                                    <input type="text" name="title_image[{{$lang->code}}]" class="form-control" id="title_image" placeholder="@lang('plachoder.enter_title_image')" value=" {{isset($service->translate($lang->code)->title_image) ? $service->translate($lang->code)->title_image : ''}} ">
                                    @error('title_image.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('title_image.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                            </div>
                            <br>




                            <div class="form-group">
                                <label>Category</label>
                                <select type="text" name="category" class="form-control">
                                    <option value="0">@lang('main.select_category') </option>
                                    @forelse($categories as $category)
                                        <option {{ ($service->category_id == $category->id) ?'selected' : '' }} value="{{$category->id}}">{{$category->translate($langs[0]->code)->name}}</option>
                                    @empty
                                    @endforelse

                                </select>
                                @error('category')
                                <div class="text-danger">{{ $errors->first('category') }}</div>
                                @enderror
                            </div>



                            <div class="form-group">

                                <div class="row">
                                    <div class="col-md-8">
                                        <lable>@lang('main.star') </lable>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="custom-control custom-checkbox">
                                            <input {{($category->star ?'checked':'')}} name="star" type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2"></label>
                                        </div>
                                    </div>
                                </div>
                                @error('star')
                                <div class="text-danger">{{ $errors->first('star') }}</div>
                                @enderror
                            </div>




                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> @lang('main.update') </button>
                    </div>


                </form>
            </div>

        </div>
    </section>
@endsection

