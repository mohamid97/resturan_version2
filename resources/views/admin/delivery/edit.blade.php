@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.edit_delivery')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.delivery') </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.delivery')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.delivery.update' , ['id'=> $user->id])}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="first_name">@lang('main.first_name')</label>
                            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="@lang('plachoder.enter_first_name')" value="{{ $user->first_name }}">
                            @error('first_name')
                            <div class="text-danger">{{ $errors->first('first_name') }}</div>
                            @enderror
                        </div>





                        <div class="form-group">
                            <label for="last_name">@lang('main.last_name') </label>
                            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="@lang('plachoder.enter_last_name')" value="{{ $user->last_name }}">
                            @error('last_name')
                            <div class="text-danger">{{ $errors->first('last_name') }}</div>
                            @enderror
                        </div>


                        <div class="form-group">@lang('main.email')</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="@lang('plachoder.enter_email')" value="{{ $user->email }}">
                            @error('email')
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                            @enderror
                        </div>



                        <div class="form-group">@lang('main.phone')</label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="@lang('plachoder.enter_phone')" value="{{ $user->phone }}">
                            @error('phone')
                            <div class="text-danger">{{ $errors->first('phone') }}</div>
                            @enderror
                        </div>








                        <div class="form-group">
                            <label for="image">@lang('main.avatar')</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="avatar" type="file" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">Choose Image</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">@lang('main.upload')</span>
                                </div>
                            </div>

                            <img src="{{asset('uploads/images/delivery/'. $user->avatar)}}" width="150px" height="150px">

                            @error('image')
                            <div class="text-danger">{{ $errors->first('avatar') }}</div>
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
