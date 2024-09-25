@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.edit_category')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.edit_category') </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.category')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.category.update' , ['id' => $cat->id]) }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">

                        <div class="border  p-3">
                        @foreach($langs as $lang)
                            <div class="form-group">
                                <label for="name">@lang('main.name') ({{ $lang->name }}) </label>
                                <input type="text" name="name[{{$lang->code}}]" class="form-control" id="name" placeholder="@lang('sidebar.enter_name')" value=" {{isset($cat->translate($lang->code)->name) ? $cat->translate($lang->code)->name : ''}} ">
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
                                    <label for="slug">@lang('main.slug') ({{ $lang->name }}) </label>
                                    <input type="text" name="slug[{{$lang->code}}]" class="form-control" id="slug" placeholder="@lang('sidebar.enter_slug')" value=" {{isset($cat->translate($lang->code)->slug) ? $cat->translate($lang->code)->slug :''}} ">
                                    @error('slug.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('slug.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                            </div>
                            <br>



                        <div class="form-group" >
                            <label>@lang('main.type')</label>
                            <select type="text" name="type" class="form-control" id="type">
                                <option value="0" {{$cat->type == 0 ?'selected':''}}>@lang('main.parent')</option>
                                <option value="1" {{$cat->type != 0 ?'selected':''}}>@lang('main.child')</option>
                            </select>
                            @error('type')
                            <div class="text-danger">{{ $errors->first('type') }}</div>
                            @enderror
                        </div>





                        




                        <div class="form-group" id="parent_id_field">
                            <label>Type</label>
                            <select type="text" name="parent_id" class="form-control">
                                <option disabled>@lang('main.select_category')</option>
                                @forelse($categories as $category)
                                    <option value="{{$category->id}}">{{$category->translate($langs[0]->code)->name}}</option>
                                @empty
                                @endforelse

                            </select>
                            @error('parent_id')
                            <div class="text-danger">{{ $errors->first('parent_id') }}</div>
                            @enderror
                        </div>


                        <div class="form-group" >
                            <label>@lang('main.has_options')</label>
                            <select type="text" name="has_options" class="form-control" id="has_options">
                                <option value="0" {{$cat->has_options == 0 ?'selected':''}}>@lang('main.no')</option>
                                <option value="1" {{$cat->has_options != 0 ?'selected':''}}>@lang('main.yes')</option>
                            </select>
                            @error('has_options')
                            <div class="text-danger">{{ $errors->first('has_options') }}</div>
                            @enderror
                        </div>

                        

                            <div class="border  p-3">
                            @foreach($langs as $index => $lang)


                                <div class="form-group">
                                    <label for="small_des">@lang('main.small_des') ({{$lang->name}})</label>
                                    <input name="small_des[{{$lang->code}}]" class="form-control" value="{{isset($cat->translate($lang->code)->small_des) ? $cat->translate($lang->code)->small_des :''}}"/>


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
                                    @if (isset($cat->translate($lang->code)->des))
                                    {!! $cat->translate($lang->code)->des !!}  
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
                                            @if (isset($cat->translate($lang->code)->meta_title))
                                            {!! $cat->translate($lang->code)->meta_title  !!} 
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
                                    <label for="meta_des">@lang('main.meta_des')({{$lang->name}})</label>
                                    <textarea name="meta_des[{{$lang->code}}]" class="ckeditor">
                                        @if (isset($cat->translate($lang->code)->meta_des))
                                        {!! $cat->translate($lang->code)->meta_des !!}
                                            
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
                                    <input name="photo" type="file" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">Choose Image</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">@lang('main.upload')</span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/category/'. $cat->photo)}}" width="150px" height="150px">

                            @error('photo')
                            <div class="text-danger">{{ $errors->first('photo') }}</div>
                            @enderror
                        </div>


                        <div class="border  p-3">
                            @foreach($langs as $lang)
                                <div class="form-group">
                                    <label for="alt_image">@lang('main.alt_image') ({{ $lang->name }}) </label>
                                    <input type="text" name="alt_image[{{$lang->code}}]" class="form-control" id="alt_image" placeholder="@lang('plachoder.enter_alt_image')" value=" {{isset($cat->translate($lang->code)->alt_image) ? $cat->translate($lang->code)->alt_image :''}} ">
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
                                    <input type="text" name="title_image[{{$lang->code}}]" class="form-control" id="title_image" placeholder="@lang('plachoder.enter_title_image')" value=" {{isset($cat->translate($lang->code)->title_image) ? $cat->translate($lang->code)->title_image:''}} ">
                                    @error('title_image.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('title_image.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                            </div>
                            <br>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <lable>@lang('main.star')</lable>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="custom-control custom-checkbox">
                                            <input {{($cat->star) ?'checked':''}} name="star" type="checkbox" class="custom-control-input" id="customCheck2">
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
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> @lang('main.submit')</button>
                    </div>


                </form>
            </div>

        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            // Hide the parent_id field initially
            $('#parent_id_field').hide();

            // Show/hide the parent_id field based on the selected value of type
            $('#type').change(function(){
                var selectedType = $(this).val();
                if(selectedType == 1) {
                    $('#parent_id_field').show();
                } else {
                    $('#parent_id_field').hide();
                }
            });
        });
    </script>
@endsection
