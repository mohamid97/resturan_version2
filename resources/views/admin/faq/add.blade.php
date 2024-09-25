@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.add_faq')  </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home') </a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.fqa')  </li>
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
                <form role="form" method="post" action="{{route('admin.faq.store')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">
                        <div class="border p-3">
                            @foreach($langs as $lang)
                                <div class="form-group">
                                    <label for="title">@lang('main.title')  ({{ $lang->name }}) </label>
                                    <input type="text" name="title[{{$lang->code}}]" class="form-control" id="title" placeholder="@lang('plachoder.enter_title')" value="{{ old('title.' . $lang->code) }}">
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
                                    <label for="question">@lang('main.question') ({{ $lang->name }}) </label>
                                    <input type="text" name="question[{{$lang->code}}]" class="form-control" id="question" placeholder="@lang('plachoder.enter_question')" value="{{ old('question.' . $lang->code) }}">
                                    @error('question.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('question.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                        <br>



                        <div class="border p-3">
                            @foreach($langs as $lang)
                                <div class="form-group">
                                    <label for="answer"> @lang('main.answer')  ({{ $lang->name }}) </label>
                                    <textarea class="ckeditor"  type="text" name="answer[{{$lang->code}}]" class="form-control" id="answer" placeholder="@lang('plachoder.enter_answer') ">
                                        {{ old('answer.' . $lang->code) }}
                                    </textarea>
                                    @error('answer.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('answer.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>

                         <br>





                        <div class="border p-3">
                            @foreach($langs as $lang)
                                <div class="form-group">
                                    <label for="des"> @lang('main.des')  ({{ $lang->name }}) </label>
                                    <textarea class="ckeditor"  type="text" name="des[{{$lang->code}}]" class="form-control" id="des" placeholder="@lang('plachoder.enter_des') ">
                                        {{ old('name.' . $lang->code) }}
                                    </textarea>
                                    @error('des.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('des.' . $lang->code) }}</div>
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
                                    <span class="input-group-text" id="">@lang('main.upload') </span>
                                </div>
                            </div>

                            @error('image')
                            <div class="text-danger">{{ $errors->first('image') }}</div>
                            @enderror
                        </div>
                         <br>


                         

                        <div class="border  p-3">

                            @foreach($langs as $lang)
                                <div class="form-group">
                                    <label for="alt_image">@lang('main.alt_image')   ({{ $lang->name }}) </label>
                                    <input type="text" name="alt_image[{{$lang->code}}]" class="form-control" id="alt_image" placeholder="@lang('plachoder.enter_alt_image') " value="{{ old('alt_image.' . $lang->code) }}">
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
                                    <label for="title_image">@lang('main.title_image')   ({{ $lang->name }}) </label>
                                    <input type="text" name="title_image[{{$lang->code}}]" class="form-control" id="title_image" placeholder="@lang('plachoder.enter_title_image') " value="{{ old('title_image.' . $lang->code)  }}">
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
