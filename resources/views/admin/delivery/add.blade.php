@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.add_delivery')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('main.delivery') </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('main.delivery')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.delivery.store')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">
                        <div class="border p-3">

                                <div class="form-group">
                                    <label for="first_name">@lang('main.first_name')  </label>
                                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="@lang('plachoder.enter_first_name')" value="{{ old('first_name') }}">
                                    @error('first_name')
                                    <div class="text-danger">{{ $errors->first('first_name.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                   
                        </div>
                        <br>


                        <div class="border p-3">

                            <div class="form-group">
                                <label for="last_name">@lang('main.last_name')  </label>
                                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="@lang('plachoder.enter_last_name')" value="{{ old('last_name') }}">
                                @error('last_name')
                                <div class="text-danger">{{ $errors->first('last_name') }}</div>
                                @enderror
                            </div>
               
                        </div>
                        <br>




                        <div class="border p-3">

                            <div class="form-group">
                                <label for="email">@lang('main.email')  </label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="@lang('plachoder.enter_email')" value="{{ old('email') }}">
                                @error('email')
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                                @enderror
                            </div>
               
                        </div>
                        <br>



                        <div class="border p-3">

                            <div class="form-group">
                                <label for="password">@lang('main.password')  </label>
                                <input type="text" name="password" class="form-control" id="password" placeholder="@lang('plachoder.enter_password')" value="{{ old('password') }}">
                                @error('password')
                                <div class="text-danger">{{ $errors->first('password') }}</div>
                                @enderror
                            </div>
               
                        </div>
                        <br>


                        <div class="border p-3">

                            <div class="form-group">
                                <label for="phone">@lang('main.phone')  </label>
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="@lang('plachoder.enter_phone')" value="{{ old('phone') }}">
                                @error('phone')
                                <div class="text-danger">{{ $errors->first('phone') }}</div>
                                @enderror
                            </div>
               
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

                            @error('photo')
                             <div class="text-danger">{{ $errors->first('image') }}</div>
                            @enderror
                        </div>


                        <br>


     














                    </div>



                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> @lang('main.submit')</button>
                    </div>


                </form>
            </div>

        </div>
    </section>
@endsection
