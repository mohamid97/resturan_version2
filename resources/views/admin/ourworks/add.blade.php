@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.add_work') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.our_work') </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.our_work') </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.our_works.store')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">
                        @foreach($langs as $lang)
                            <div class="form-group">
                                <label for="name">@lang('main.name')  ({{ $lang->name }}) </label>
                                <input type="text" name="name[{{$lang->code}}]" class="form-control" id="name" placeholder="@lang('plachoder.enter_name') " value="{{ old('name.' . $lang->code) }}">
                                @error('name.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('name.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach



                            @foreach($langs as $index => $lang)


                                <div class="form-group">
                                    <label for="description">@lang('main.des') ({{$lang->name}})</label>
                                    <textarea name="des[{{$lang->code}}]" class="ckeditor">

                                    </textarea>

                                    @error('des.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('des.' . $lang->code) }}</div>
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

                            @error('photo')
                            <div class="text-danger">{{ $errors->first('photo') }}</div>
                            @enderror
                        </div>



                            <br>
                            <div class="border  p-3">

                                @foreach($langs as $lang)
                                    <div class="form-group">
                                        <label for="alt_image">@lang('main.alt_image') ({{ $lang->name }}) </label>
                                        <input type="text" name="alt_image[{{$lang->code}}]" class="form-control" id="alt_image" placeholder="@lang('plachoder.enter_alt_image')" value="{{ old('alt_image.' . $lang->code) }}">
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
                                        <label for="title_image">@lang('main.title_image')  ({{ $lang->name }}) </label>
                                        <input type="text" name="title_image[{{$lang->code}}]" class="form-control" id="title_image" placeholder="@lang('plachoder.enter_title_image')" value="{{ old('title_image.' . $lang->code) }}">
                                        @error('title_image.' . $lang->code)
                                        <div class="text-danger">{{ $errors->first('title_image.' . $lang->code) }}</div>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>

                            <br>

                            <div class="border  p-3">

                                @foreach($langs as $index => $lang)

                                    <div class="form-group">
                                        <label for="meta_title">@lang('main.meta_title')({{$lang->name}})</label>
                                        <textarea name="meta_title[{{$lang->code}}]" class="ckeditor">

                                        </textarea>

                                        @error('meta_title.' . $lang->code)
                                        <div class="text-danger">{{ $errors->first('meta_title.' . $lang->code) }}</div>
                                        @enderror
                                    </div>
                                @endforeach

                            </div>

                            <br>

                            <div class="border  p-3">


                                @foreach($langs as $index => $lang)
                                    <div class="form-group">
                                        <label for="meta_des">@lang('main.meta_des') ({{$lang->name}})</label>
                                        <textarea name="meta_des[{{$lang->code}}]" class="ckeditor">

                                        </textarea>

                                        @error('meta_des.' . $lang->code)
                                        <div class="text-danger">{{ $errors->first('meta_des.' . $lang->code) }}</div>
                                        @enderror
                                    </div>
                                @endforeach

                            </div>





                            <br>
                            <div class="form-group">
                                <label for="icon">@lang('main.icon')</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="icon" type="file" class="custom-file-input" id="icon">
                                        <label class="custom-file-label" for="icon">Choose Icon</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">@lang('main.upload')</span>
                                    </div>
                                </div>

                                @error('icon')
                                <div class="text-danger">{{ $errors->first('icon') }}</div>
                                @enderror
                            </div>






                        <div class="form-group">
                            <label for="name">@lang('main.link')</label>
                            <input type="text" name="link" class="form-control" id="link" placeholder="@lang('plachoder.enter_link')" value="{{ old('link') }}">

                            @error('link')
                            <div class="text-danger">{{ $errors->first('link') }}</div>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label>@lang('main.media')</label>
                            <select type="text" name="media_id" class="form-control">
                                <option value="0">@lang('main.select_media')</option>
                                @forelse($medias as $media)
                                    <option value="{{$media->id}}">{{$media->name}}</option>
                                @empty
                                @endforelse

                            </select>
                            @error('media')
                            <div class="text-danger">{{ $errors->first('media') }}</div>
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
