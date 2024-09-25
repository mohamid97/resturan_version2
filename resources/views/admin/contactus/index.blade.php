@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.contact_us')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.contact_us') </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.contact_us')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.contact.update' , ['id'=> $contactus->id])}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">

                        <div class="border  p-3">

                        @foreach($langs as $lang)
                            <div class="form-group">
                                <label for="name">@lang('main.name') ({{ $lang->name }}) </label>
                                <input type="text" name="name[{{$lang->code}}]" class="form-control" id="name" placeholder="@lang('plachoder.enter_name')" value="{{isset($contactus->translate($lang->code)->name)?$contactus->translate($lang->code)->name:''}}">
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
                                    <label for="address">@lang('main.address') ({{ $lang->name }}) </label>
                                    <input type="text" name="address[{{$lang->code}}]" class="form-control" id="address" placeholder="@lang('plachoder.enter_address')" value="{{isset($contactus->translate($lang->code)->address)?$contactus->translate($lang->code)->address:''}}">
                                    @error('address.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('address.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach

                        </div>
                    <br>


                    <div class="border  p-3">

                        @foreach($langs as $lang)
                            <div class="form-group">
                                <label for="address">@lang('main.address2') ({{ $lang->name }}) </label>
                                <input type="text" name="address2[{{$lang->code}}]" class="form-control" id="address2" placeholder="@lang('plachoder.enter_address')" value="{{isset($contactus->translate($lang->code)->address2)?$contactus->translate($lang->code)->address2:''}}">
                                @error('address2.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('address2.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach

                    </div>
                <br>








                        <div class="border  p-3">
                            <div class="form-group">
                                <label for="phone1">@lang('main.phone') 1</label>
                                <input type="text" name="phone1" class="form-control" id="phone1" placeholder="@lang('plachoder.enter_phone') 1" value="{{ $contactus->phone1 }}">
                                @error('phone1')
                                <div class="text-danger">{{ $errors->first('phone1') }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone2">@lang('main.phone') 2</label>
                                <input type="text" name="phone2" class="form-control" id="phone1" placeholder="@lang('plachoder.enter_phone') 2" value="{{ $contactus->phone2 }}">
                                @error('phone2')
                                <div class="text-danger">{{ $errors->first('phone2') }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="phone3">@lang('main.phone') 3</label>
                                <input type="text" name="phone3" class="form-control" id="phone3" placeholder="@lang('plachoder.enter_phone')3" value="{{ $contactus->phone3 }}">
                                @error('phone3')
                                <div class="text-danger">{{ $errors->first('phone3') }}</div>
                                @enderror
                            </div>
                        </div>
                    <br>





                        <div class="form-group">
                            <label for="email">@lang('main.email')</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="@lang('plachoder.enter_email')" value="{{ $contactus->email }}">
                            @error('email')
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                            @enderror
                        </div>





                    <br>
                    <div class="border  p-3">

                            @foreach($langs as $index => $lang)


                                <div class="form-group">
                                    <label for="des">@lang('main.des') ({{$lang->name}})</label>
                                    <textarea name="des[{{$lang->code}}]" class="ckeditor">
                                          {{isset($contactus->translate($lang->code)->des)?$contactus->translate($lang->code)->des:''}}
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
                                    <input name="photo" type="file" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">Choose Image</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">@lang('main.upload')</span>
                                </div>
                            </div>
                            @if($contactus->photo && $contactus->photo != null)
                                <img src="{{asset('uploads/images/contactus/'. $contactus->photo)}}" width="150px" height="150px">

                            @endif

                            @error('photo')
                            <div class="text-danger">{{ $errors->first('photo') }}</div>
                            @enderror
                        </div>


                        <br>
                        <div class="border  p-3">

                            @foreach($langs as $lang)
                                <div class="form-group">
                                    <label for="alt_image">@lang('main.alt_image')  ({{ $lang->name }}) </label>
                                    <input type="text" name="alt_image[{{$lang->code}}]" class="form-control" id="alt_image" placeholder="@lang('plachoder.enter_alt_image')" value="{{isset($contactus->translate($lang->code)->alt_image)?$contactus->translate($lang->code)->alt_image:''}}">
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
                                    <input type="text" name="title_image[{{$lang->code}}]" class="form-control" id="title_image" placeholder="@lang('plachoder.enter_title_image')" value="{{isset($contactus->translate($lang->code)->title_image)?$contactus->translate($lang->code)->title_image:''}}">
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
                                    <label for="meta_title">@lang('main.meta_title') ({{$lang->name}})</label>
                                    <textarea name="meta_title[{{$lang->code}}]" class="ckeditor">

                                        @if (isset($contactus->translate($lang->code)->meta_title))
                                        {{$contactus->translate($lang->code)->meta_title}}
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
                                        @if (isset($contactus->translate($lang->code)->meta_des))
                                        {{$contactus->translate($lang->code)->meta_des}}
                                        @endif
                                    </textarea>

                                    @error('meta_des.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('meta_des.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach

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


