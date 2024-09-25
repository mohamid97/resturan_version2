@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.edit_faq') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home') </a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.edit_faq')  </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.faq') </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.faq.update' , ['id' => $faq->id]) }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">

                        <div class="border  p-3">
                        @foreach($langs as $lang)
                            <div class="form-group">
                                <label for="name">@lang('main.title')  ({{ $lang->name }}) </label>
                                <input type="text" name="title[{{$lang->code}}]" class="form-control" id="title" placeholder="@lang('plachoder.enter_title') " value=" {{isset($faq->translate($lang->code)->title) ? $faq->translate($lang->code)->title : ''}} ">
                                @error('title.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('title.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach
                        </div>
                        <br>


                        <div class="border  p-3">
                            @foreach($langs as $index => $lang)
                                <div class="form-group">
                                    <label for="image">@lang('main.des')  ({{$lang->name}})</label>
                                    <textarea name="des[{{$lang->code}}]" class="ckeditor">
                                        @if (isset($faq->translate($lang->code)->des))
                                        {!! $faq->translate($lang->code)->des !!}  
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
                            @foreach($langs as $lang)
                                <div class="form-group">
                                    <label for="question">@lang('main.question')  ({{ $lang->name }}) </label>
                                    <input type="text" name="question[{{$lang->code}}]" class="form-control" id="question" placeholder="@lang('plachoder.enter_question')  " value=" {{isset($faq->translate($lang->code)->question) ? $faq->translate($lang->code)->question : ''}} ">
                                    @error('question.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('question.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                            </div>
                            <br>
    
    
                                <div class="border  p-3">
                                    @foreach($langs as $index => $lang)

                                        <div class="form-group">
                                            <label for="answer">@lang('main.answer')  ({{$lang->name}})</label>
                                            <textarea name="answer[{{$lang->code}}]" class="ckeditor">
                                                @if (isset($faq->translate($lang->code)->answer))
                                                {!! $faq->translate($lang->code)->answer !!}  
                                                @endif    
                                            </textarea>
    
                                            @error('answer.' . $lang->code)
                                            <div class="text-danger">{{ $errors->first('answer .' . $lang->code) }} </div>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                                <br>


                                


                        <div class="form-group">
                            <label for="image">@lang('main.image') </label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="image" type="file" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">Choose Image</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">@lang('main.uplaod') </span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/faq/'. $faq->image)}}" width="150px" height="150px">

                            @error('image')
                            <div class="text-danger">{{ $errors->first('image') }}</div>
                            @enderror
                        </div>


                        <div class="border  p-3">
                            @foreach($langs as $lang)
                                <div class="form-group">
                                    <label for="alt_image">@lang('main.alt_image') ({{ $lang->name }}) </label>
                                    <input type="text" name="alt_image[{{$lang->code}}]" class="form-control" id="alt_image" placeholder="@lang('plachoder.enter_alt_image') " value=" {{isset($faq->translate($lang->code)->alt_image) ? $faq->translate($lang->code)->alt_image :''}} ">
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
                                    <label for="title_image">@lang('main.title_image')  ({{ $lang->name }}) </label>
                                    <input type="text" name="title_image[{{$lang->code}}]" class="form-control" id="title_image" placeholder="@lang('plachoder.enter_title_image') " value=" {{isset($faq->translate($lang->code)->title_image) ? $faq->translate($lang->code)->title_image:''}} ">
                                    @error('title_image.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('title_image.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                            </div>
                            <br>





                    </div>



                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> @lang('main.submit') </button>
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
