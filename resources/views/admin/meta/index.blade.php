
@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Website Meta</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Meta  </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Meta</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.meta.update')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                    <div class="card-body">


                     @foreach($langs as $lang)
                            <div class="form-group">
                                <label>Meta Keywords ({{$lang->name}})</label>
                                <textarea class="ckeditor" type="text" name="meta_keywords[{{$lang->code}}]" class="form-control"  placeholder="Enter Keywords">
                                    @if($meta && $meta != null && $meta->{'meta_keywords:'.$lang->code.''} )
                                        {!! $meta->{'meta_keywords:'.$lang->code.''} !!}
                                    @endif

                                </textarea>
                                @error('meta_keywords.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('meta_keywords.' . $lang->code) }}</div>
                                @enderror
                            </div>
                     @endforeach




                         @foreach($langs as $lang)
                             <div class="form-group">
                                 <label> Meta Description ({{$lang->name}}) </label>
                                 <textarea class="ckeditor" type="text" name="meta_des[{{$lang->code}}]" class="form-control"  placeholder="Enter Meta Description">
                                    @if($meta && $meta != null && $meta->{'meta_des:'.$lang->code.''} )
                                         {!! $meta->{'meta_des:'.$lang->code.''} !!}
                                     @endif
                                </textarea>
                                 @error('meta_des.' . $lang->code)
                                 <div class="text-danger">{{ $errors->first('meta_des.' . $lang->code) }}</div>
                                 @enderror
                             </div>
                         @endforeach



                         @foreach($langs as $lang)
                         <div class="form-group">
                             <label> Meta Title ({{$lang->name}}) </label>
                             <textarea class="ckeditor" type="text" name="meta_title[{{$lang->code}}]" class="form-control"  placeholder="Enter Meta Title">
                                @if($meta && $meta != null && $meta->{'meta_title:'.$lang->code.''} )
                                     {!! $meta->{'meta_title:'.$lang->code.''} !!}
                                 @endif
                            </textarea>
                             @error('meta_title.' . $lang->code)
                             <div class="text-danger">{{ $errors->first('meta_title.' . $lang->code) }}</div>
                             @enderror
                         </div>
                     @endforeach




                         @foreach($langs as $lang)
                             <div class="form-group">
                                 <label> Meta Tags ({{$lang->name}}) </label>
                                 <textarea class="ckeditor" type="text" name="meta_tags[{{$lang->code}}]" class="form-control"  placeholder="Enter Meta Tags">
                                    @if($meta && $meta != null && $meta->{'meta_tags:'.$lang->code.''} )
                                         {!! $meta->{'meta_tags:'.$lang->code.''} !!}
                                     @endif
                                </textarea>
                                 @error('meta_tags.' . $lang->code)
                                 <div class="text-danger">{{ $errors->first('meta_tags.' . $lang->code) }}</div>
                                 @enderror
                             </div>
                         @endforeach



                         <div class="form-group">
                             <label for="website_name">Website Name</label>
                             <input type="text" name="website_name" class="form-control" id="website_name" placeholder="Enter website_name" value="{{ isset($meta->website_name) ? $meta->website_name: ''  }}">

                             @error('website_name')
                             <div class="text-danger">{{ $errors->first('website_name') }}</div>
                             @enderror
                         </div>


                         <div class="form-group">
                             <label for="website_des">Website Description</label>
                             <input type="text" name="website_des" class="form-control" id="website_name" placeholder="Enter website Description" value="{{ isset($meta->website_des) ? $meta->website_des: '' }}">

                             @error('website_des')
                             <div class="text-danger">{{ $errors->first('website_des') }}</div>
                             @enderror
                         </div>


                         <div class="form-group">
                             <label for="author">Website Author</label>
                             <input type="text" name="author" class="form-control" id="author" placeholder="Enter website author" value="{{ isset($meta->author) ? $meta->author: ''}}">

                             @error('author')
                             <div class="text-danger">{{ $errors->first('author') }}</div>
                             @enderror
                         </div>








                    </div>



                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> Update</button>
                    </div>


                </form>
            </div>

        </div>
    </section>
@endsection


