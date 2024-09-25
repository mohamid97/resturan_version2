@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.social_media') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.social_media') </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.social_media')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.social_media.update' , ['id'=> $social->id])}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="facebook">@lang('main.facebook')</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="facebook" class="form-control" id="facebook" placeholder="Enter facebook" value="{{ $social->facebook }}">

                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($social->facebook_option ?'checked':'')}} name="facebook_option" type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1"></label>
                                    </div>
                                </div>
                            </div>
                            @error('facebook')
                            <div class="text-danger">{{ $errors->first('facebook') }}</div>
                            @enderror
                        </div>




                        <div class="form-group">
                            <label for="twitter">@lang('main.twitter')</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="twitter" class="form-control" id="twitter" placeholder="Enter Twitter" value="{{ $social->twitter }}">

                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input  {{($social->twitter_option ?'checked':'')}} name="twitter_option" type="checkbox" class="custom-control-input" id="customCheck2" >
                                        <label class="custom-control-label" for="customCheck2"></label>
                                    </div>
                                </div>
                            </div>
                            @error('twitter')
                            <div class="text-danger">{{ $errors->first('twitter') }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="linkedin">@lang('main.linkedin')</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="linkedin" class="form-control" id="linkedin" placeholder="Enter Linkedin" value="{{ $social->linkedin }}">
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input  {{($social->linkedin_option ?'checked':'')}} name="linkedin_option" type="checkbox" class="custom-control-input" id="customCheck40" >
                                        <label class="custom-control-label" for="customCheck40"></label>
                                    </div>
                                </div>
                            </div>
                            @error('linkedin')
                            <div class="text-danger">{{ $errors->first('linkedin') }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="twitter">@lang('main.instagram')</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="instagram" class="form-control" id="instagram" placeholder="Enter Instagram" value="{{ $social->instagram }}">

                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($social->instagram_option ?'checked':'')}}  name="instagram_option" type="checkbox" class="custom-control-input" id="customCheck3" >
                                        <label class="custom-control-label" for="customCheck3"></label>
                                    </div>
                                </div>
                            </div>
                            @error('instagram')
                            <div class="text-danger">{{ $errors->first('instagram') }}</div>
                            @enderror
                        </div>





                        <div class="form-group">
                            <label for="youtube">@lang('main.youtube')</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="youtube" class="form-control" id="youtube" placeholder="Enter Youtube" value="{{ $social->youtube }}">

                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($social->youtube_option ?'checked':'')}} name="youtube_option" type="checkbox" class="custom-control-input" id="customCheck4">
                                        <label class="custom-control-label" for="customCheck4"></label>
                                    </div>
                                </div>
                            </div>
                            @error('youtube')
                            <div class="text-danger">{{ $errors->first('youtube') }}</div>
                            @enderror
                        </div>





                        <div class="form-group">
                            <label for="snapchat">@lang('main.snapchat')</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="snapchat" class="form-control" id="snapchat" placeholder="Enter snapchat" value="{{ $social->snapchat }}">

                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input  {{($social->snapchat_option ?'checked':'')}} name="snapchat_option" type="checkbox" class="custom-control-input" id="customCheck6" >
                                        <label class="custom-control-label" for="customCheck6"></label>
                                    </div>
                                </div>
                            </div>
                            @error('snapchat')
                            <div class="text-danger">{{ $errors->first('snapchat') }}</div>
                            @enderror
                        </div>






                        <div class="form-group">
                            <label for="twitter">@lang('main.tiktok')</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="tiktok" class="form-control" id="tiktok" placeholder="Enter Tiktok" value="{{ $social->instagram }}">

                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($social->tiktok_option ?'checked':'')}} name="tiktok_option" type="checkbox" class="custom-control-input" id="customCheck5" >
                                        <label class="custom-control-label" for="customCheck5"></label>
                                    </div>
                                </div>
                            </div>
                            @error('tiktok')
                            <div class="text-danger">{{ $errors->first('tiktok') }}</div>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="twitter">@lang('main.skype')</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="skype" class="form-control" id="tiktok" placeholder="Enter skype" value="{{ $social->skype }}">

                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($social->skype_option ?'checked':'')}} name="skype_option" type="checkbox" class="custom-control-input" id="customCheck50" >
                                        <label class="custom-control-label" for="customCheck50"></label>
                                    </div>
                                </div>
                            </div>
                            @error('tiktok')
                            <div class="text-danger">{{ $errors->first('tiktok') }}</div>
                            @enderror
                        </div>




                        <div class="form-group">
                            <label for="whatsup">@lang('main.whatsup')</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="whatsup" class="form-control" id="whatsup" placeholder="Enter Whatsup" value="{{ $social->whatsup }}">

                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($social->whatsup_option ?'checked':'')}} name="whatsup_option" type="checkbox" class="custom-control-input" id="customCheck8" >
                                        <label class="custom-control-label" for="customCheck8"></label>
                                    </div>
                                </div>
                            </div>
                            @error('whatsup')
                            <div class="text-danger">{{ $errors->first('whatsup') }}</div>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="whatsup">@lang('main.email')</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{ $social->email }}">

                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($social->email_option ?'checked':'')}} name="email_option" type="checkbox" class="custom-control-input" id="customCheck20" >
                                        <label class="custom-control-label" for="customCheck20"></label>
                                    </div>
                                </div>
                            </div>
                            @error('email')
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="phone">@lang('main.phone')</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone" value="{{ $social->phone }}">

                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($social->phone_option ?'checked':'')}} name="phone_option" type="checkbox" class="custom-control-input" id="customCheck30" >
                                        <label class="custom-control-label" for="customCheck30"></label>
                                    </div>
                                </div>
                            </div>
                            @error('phone')
                            <div class="text-danger">{{ $errors->first('phone') }}</div>
                            @enderror
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


@section('scripts')
    <script>
        // function updateInputName(checkbox) {
        //     const inputName = checkbox.checked ? 'true' : 'false';
        //     checkbox.value = inputName;
        // }
    </script>
@endsection
