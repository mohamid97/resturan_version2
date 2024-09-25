@extends('admin.layout.master')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.add_branch')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.add_branch') </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.branchs')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.branches.store') }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">


                        @foreach($langs as $lang)
                            <div class="form-group">
                                <label for="name">@lang('main.name') ({{ $lang->name }}) </label>
                                <input type="text" name="name[{{$lang->code}}]" class="form-control" id="name" placeholder="@lang('plachoder.enter_name')" value="{{ old('name.' . $lang->code) }}">
                                @error('name.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('name.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach




                        @foreach($langs as $index => $lang)


                            <div class="form-group">
                                <label for="image">@lang('main.des') ({{$lang->name}})</label>
                                <textarea name="des[{{$lang->code}}]" class="ckeditor">

                                </textarea>

                                @error('des.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('des.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach



                        
                        @foreach($langs as $index => $lang)


                            <div class="form-group">
                                <label for="image">@lang('main.address') ({{$lang->name}})</label>
                                <textarea name="address[{{$lang->code}}]" class="ckeditor">

                                </textarea>

                                @error('address.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('address.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach


                        <div class="form-group">
                            <label for="location">@lang('main.location') </label>
                            <input type="text" name="location" class="form-control" id="location" placeholder="@lang('plachoder.enter_location')" value="{{ old('location') }}">
                            @error('location')
                            <div class="text-danger">{{ $errors->first('location') }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone1">@lang('main.phone') </label>
                            <input type="text" name="phone1" class="form-control" id="phone1" placeholder="@lang('plachoder.enter_phone')" value="{{ old('phone1') }}">
                            @error('phone1')
                            <div class="text-danger">{{ $errors->first('phone1') }}</div>
                            @enderror
                        </div>


                        
                        <div class="form-group">
                            <label for="phone2">@lang('main.phone')  </label>
                            <input type="text" name="phone2" class="form-control" id="phone2" placeholder="@lang('plachoder.enter_phone')" value="{{ old('phone2') }}">
                            @error('phone2')
                            <div class="text-danger">{{ $errors->first('phone2') }}</div>
                            @enderror
                        </div>




                        <div class="form-group">
                            <label for="whatsup">@lang('main.whatsup')  </label>
                            <input type="text" name="whatsup" class="form-control" id="whatsup" placeholder="@lang('plachoder.enter_whatsup')" value="{{ old('whatsup') }}">
                            @error('whatsup')
                            <div class="text-danger">{{ $errors->first('whatsup') }}</div>
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

