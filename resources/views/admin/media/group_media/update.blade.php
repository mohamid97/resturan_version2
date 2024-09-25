@extends('admin.layout.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('main.edit_group_media')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('main.media_group')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('main.media_group')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.group_media.update' , ['id'=> $media->id])}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">


                                <div class="form-group">
                                    <label for="des">@lang('main.name') </label>
                                    <input type="text" name="name" class="form-control" id="des" placeholder="@lang('plachoder.enter_name')" value="{{ $media->name }}">
                                    @error('name')
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                    @enderror
                                </div>

                                <div class="border p-3">
                                    @foreach($langs as $lang)
                                        <div class="form-group">
                                            <label for="title">@lang('main.title') ({{ $lang->name }}) </label>
                                            <input type="text" name="title[{{$lang->code}}]" class="form-control" id="title" placeholder="@lang('plachoder.enter_title')" value="{{ $media->translate($lang->code)->title }}">
                                            @error('title.' . $lang->code)
                                            <div class="text-danger">{{ $errors->first('title.' . $lang->code) }}</div>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                                <br>


                                <div class="border p-3">
                                    @foreach($langs as $lang)
                                        <div class="form-group">
                                            <label for="small_des">@lang('main.small_des') ({{ $lang->name }}) </label>
                                            <textarea  type="text" name="small_des[{{$lang->code}}]" class="form-control" id="small_des" placeholder="@lang('plachoder.enter_small_des')">
                                              {{ $media->translate($lang->code)->small_des }}
                                            </textarea>
                                            @error('small_des.' . $lang->code)
                                            <div class="text-danger">{{ $errors->first('small_des.' . $lang->code) }}</div>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                                <br>



                                <div class="border p-3">
                                    @foreach($langs as $lang)
                                        <div class="form-group">
                                            <label for="des"> @lang('main.des') ({{ $lang->name }}) </label>
                                            <textarea class="ckeditor"  type="text" name="des[{{$lang->code}}]" class="form-control" id="des" placeholder="@lang('plachoder.enter_des')">
                                              {!! $media->translate($lang->code)->des !!}
                                            </textarea>
                                            @error('des.' . $lang->code)
                                            <div class="text-danger">{{ $errors->first('des.' . $lang->code) }}</div>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>


                                <br>
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
        
                                    @if($media->image && $media->image != null)
                                    <img src="{{asset('uploads/images/media_group/'. $media->image)}}" width="150px" height="150px">
        
                                @endif
        
                                    @error('image')
                                    <div class="text-danger">{{ $errors->first('image') }}</div>
                                    @enderror
                                </div>
                                 <br>
        
                                <div class="border  p-3">
        
                                    @foreach($langs as $lang)
                                        <div class="form-group">
                                            <label for="alt_image">@lang('main.alt_image') ({{ $lang->name }}) </label>
                                            <input type="text" name="alt_image[{{$lang->code}}]" class="form-control" id="alt_image" placeholder="@lang('plachoder.alt_image')" value="{{ $media->translate($lang->code)->alt_image }}">
                                            @error('alt_image.' . $lang->code)
                                            <div class="text-danger">{{ $errors->first('alt_image.' . $lang->code) }}</div>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                                <br>
        
        
                                <div class="border p-3">
                                    @foreach($langs as $lang)
                                        <div class="form-group">
                                            <label for="title_image">@lang('main.title_image') ({{ $lang->name }}) </label>
                                            <input type="text" name="title_image[{{$lang->code}}]" class="form-control" id="title_image" placeholder="@lang('plachoder.enter_title_image')" value=" {{ $media->translate($lang->code)->title_image }}">
                                            @error('title_image.' . $lang->code)
                                            <div class="text-danger">{{ $errors->first('title_image.' . $lang->code) }}</div>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
        
                                 <br>








 

                    </div>



                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> @lang('main.submit')</button>
                    </div>


                </form>
            </div>

        </div>
    </section>





@endsection
