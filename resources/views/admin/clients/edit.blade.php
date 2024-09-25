@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> @lang('sidebar.edit_client')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"> @lang('main.home')</a></li>
                        <li class="breadcrumb-item active"> @lang('sidebar.clients') </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"> @lang('sidebar.clients')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.our_clients.update' , ['id' => $client->id])}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name"> @lang('main.name')</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="@lang('plachoder.enter_name')"" value="{{ $client->name }}">
                        </div>

                        @error('name')
                        <div class="text-danger">{{ $errors->first('name') }}</div>
                        @enderror


                        <div class="form-group">
                            <label for="address">@lang('main.address')</label>
                            <input name="address" type="text" class="form-control" id="address" placeholder="@lang('plachoder.enter_address')" value="{{ $client->address }}">
                            @error('address')
                            <div class="text-danger">{{ $errors->first('address') }}</div>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="image">@lang('main.icon')</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="icon" type="file" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">Choose Icon</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">@lang('main.upload')"</span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/clients/'. $client->icon)}}" width="70px" height="70px">


                            @error('icon')
                            <div class="text-danger">{{ $errors->first('icon') }}</div>
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
