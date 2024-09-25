@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Slider Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Slider</a></li>
                        <li class="breadcrumb-item active">Setting </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Slider</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.sliders.setting_update')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-7">
                                    <label for="setting">Disabled | Enabled</label>
                                </div>
                                <div class="col-md-5">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($setting && $setting->setting ?'checked':'')}} name="setting" type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1"></label>
                                    </div>
                                </div>
                            </div>




                            @error('setting')
                            <div class="text-danger">{{ $errors->first('setting') }}</div>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="height">Slider Height</label>
                            <input  name="height" type="text" class="form-control" id="height" value="{{($setting && $setting->height) ? $setting->height :''}}">
                            @error('height')
                            <div class="text-danger">{{ $errors->first('height') }}</div>
                            @enderror
                        </div>




                        <div class="form-group">
                            <label for="height">Slider Width</label>
                            <input  name="width" type="text" class="form-control" id="width" value="{{ ($setting && $setting->width) ? $setting->width :''}}">
                            @error('width')
                            <div class="text-danger">{{ $errors->first('width') }}</div>
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


