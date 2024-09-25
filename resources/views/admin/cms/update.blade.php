@extends('admin.layout.master')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.edit_article')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.edit_article')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.article')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.cms.update' , ['id'=> $blog->id]) }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">

                        <div class="border  p-3">
                        @foreach($langs as $lang)
                            <div class="form-group">
                                <label for="title">@lang('main.title') ({{ $lang->name }}) </label>
                                <input type="text" name="title[{{$lang->code}}]" class="form-control" id="title" placeholder="@lang('plachoder.enter_title')" value="{{ isset($blog->translate($lang->code)->name)? $blog->translate($lang->code)->name:'' }}">
                                @error('title.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('title.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach
                        </div>
                        <br>



                        <div class="border  p-3">
                        
                            @foreach($langs as $lang)
                                <div class="form-group">
                                    <label for="slug">@lang('main.slug') ({{ $lang->name }}) </label>
                                    <input type="text" name="slug[{{$lang->code}}]" class="form-control" id="slug" placeholder="@lang('plachoder.enter_slug')" value="{{ isset($blog->translate($lang->code)->slug) ? $blog->translate($lang->code)->slug : '' }}">
                                    @error('slug.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('slug.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                        <br>


                        <div class="border  p-3">
                            @foreach($langs as $index => $lang)
    
                                <div class="form-group">
                                    <label for="small_des">@lang('main.small_des') ({{$lang->name}})</label>
                                    <textarea class="form-control" name="small_des[{{$lang->code}}]">
                                        @if (isset($blog->translate($lang->code)->small_des))
                                           {{ $blog->translate($lang->code)->small_des  }}
                                        @endif      
                                    </textarea>
    
                                    @error('small_des.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('small_des.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                            </div>
                            <br>







                        <div class="border  p-3">

                        @foreach($langs as $index => $lang)

                            <div class="form-group">
                                <label for="image">@lang('main.des') ({{$lang->name}})</label>
                                <textarea name="des[{{$lang->code}}]" class="ckeditor">

                                    @if (isset($blog->translate($lang->code)->des))
                                       {!! $blog->translate($lang->code)->des  !!}
                                    @endif
                                    

                                </textarea>

                                @error('des.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('des.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach
                        </div>
                        <br>


                        <div class="border  p-3">

                            @foreach($langs as $index => $lang)
                                <div class="form-group">
                                    <label for="meta_title">@lang('main.meta_title') ({{$lang->name}})</label>
                                    <textarea name="meta_title[{{$lang->code}}]" class="ckeditor">

                                        @if (isset($blog->translate($lang->code)->meta_title))
                                           {!! $blog->translate($lang->code)->meta_title  !!}
                                        @endif
                                       

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

                                        @if (isset($blog->translate($lang->code)->meta_title))
                                            {!! $blog->translate($lang->code)->meta_des  !!}
                                        @endif
                                       

                                    </textarea>

                                    @error('meta_des.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('meta_des.' . $lang->code) }}</div>
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
                            <img src="{{asset('uploads/images/cms/'. $blog->image)}}" width="150px" height="150px">
                            @error('image')
                            <div class="text-danger">{{ $errors->first('image') }}</div>
                            @enderror
                        </div>
                        <br>
                        <div class="border  p-3">

                            @foreach($langs as $lang)
                                <div class="form-group">
                                    <label for="alt_image">@lang('main.alt_image') ({{ $lang->name }}) </label>
                                    <input type="text" name="alt_image[{{$lang->code}}]" class="form-control" id="alt_image" placeholder="@lang('plachoder.enter_alt_image')" value="{{  isset($blog->translate($lang->code)->alt_image) ? $blog->translate($lang->code)->alt_image :''   }}">
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
                                    <input type="text" name="title_image[{{$lang->code}}]" class="form-control" id="title_image" placeholder="@lang('plachoder.enter_title_image')" value="{{  isset($blog->translate($lang->code)->title_image) ? $blog->translate($lang->code)->title_image :''   }}">
                                    @error('title_image.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('title_image.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>









{{--                        <div class="form-group">--}}
{{--                            <label>Category</label>--}}
{{--                            <select type="text" name="category" class="form-control">--}}
{{--                                <option value="0">Select Category</option>--}}
{{--                                @forelse($categories as $category)--}}
{{--                                    <option value="{{$category->id}}">{{$category->translate($langs[0]->code)->name}}</option>--}}
{{--                                @empty--}}
{{--                                @endforelse--}}

{{--                            </select>--}}
{{--                            @error('category')--}}
{{--                            <div class="text-danger">{{ $errors->first('category') }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}


                    </div>



                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> @lang('main.update')</button>
                    </div>


                </form>
            </div>

        </div>
    </section>
@endsection

