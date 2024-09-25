@extends('admin.layout.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('main.edit_video')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('main.videos') </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('main.videos')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.videos.update' , ['id'=>$video->id])}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">
                        @foreach($langs as $lang)
                            <div class="form-group">
                                <label for="name">@lang('main.name') ({{ $lang->name }}) </label>
                                <input type="text" name="name[{{$lang->code}}]" class="form-control" id="name" placeholder="@lang('plachoder.enter_name')" value="{{ $video->translate($lang->code)->name }}">
                                @error('name.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('name.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach







                        <div class="form-group">
                            <label for="image">@lang('main.photo')</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="photo" type="file" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">Choose Photo</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">@lang('main.upload')</span>
                                </div>
                            </div>
                            @if($video->image)
                                <img src="{{asset('uploads/images/media/videos/'. $video->image)}}" width="150px" height="150px">
                            @endif
                            @error('photo')
                            <div class="text-danger">{{ $errors->first('photo') }}</div>
                            @enderror
                        </div>


                        <br>
                        <div class="form-group">
                            <label for="link">@lang('main.link')</label>
                            <input type="text" name="link" class="form-control" id="link" placeholder="@lang('plachoder.enter_link') " value="{{$video->link}}">
                            @error('link')
                            <div class="text-danger">{{ $errors->first('link') }}</div>
                            @enderror
                        </div>


                        <br>


                        <div class="border p-3">
                            @foreach($langs as $lang)
                                <div class="form-group">
                                    <label for="des">@lang('main.des') ({{ $lang->name }}) </label>
                                    <input type="text" name="des[{{$lang->code}}]" class="form-control" id="des" placeholder="@lang('plachoder.enter_des')" value="{{ $video->translate($lang->code)->des }}">
                                    @error('des.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('des.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>


                        <div class="border p-3">
                             
                            <div class="form-group">
                                <label for="title_image">@lang('main.media_group')  </label>
                                <select type="text" name="group_media" class="form-control" id="group_media">
                                    @foreach ($media_groups as $media )
                                        <option value="{{ $media->id }}" {{ ( $video->media_group_id == $media->id ) ? 'selected':'' }}>{{ $media->name }}</option>
                                    @endforeach
                                </select>
                                @error('group_media')
                                <div class="text-danger">{{ $errors->first('group_media') }}</div>
                                @enderror
                            </div>
                 
                    </div>




                    </div>



                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> @lang('main.update')</button>
                    </div>


                </form>
            </div>

        </div>
    </section>





@endsection
