@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.edit_branch')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.edit_branch')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.types')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.branches.update' , ['id'=> $branch->id]) }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">
                        <div class="border  p-3">

                        @foreach($langs as $lang)
                            <div class="form-group">
                                <label for="name">@lang('main.name') ({{ $lang->name }}) </label>
                                <input type="text" name="name[{{$lang->code}}]" class="form-control" id="name" placeholder="@lang('plachoder.enter_name')" value="{{ isset($branch->translate($lang->code)->name) ? $branch->translate($lang->code)->name :''}}">
                                @error('name.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('name.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach

                        </div>

                        <br>


                        <div class="border  p-3">

                      
                                <div class="form-group">
                                    <label for="phone1">@lang('main.phone') </label>
                                    <input type="text" name="phone1" class="form-control" id="phone1" placeholder="@lang('plachoder.enter_phone')" value="{{ isset($branch->phone1) ? $branch->phone1 :'' }}">
                                    @error('phone1')
                                    <div class="text-danger">{{ $errors->first('phone1') }}</div>
                                    @enderror
                                </div>
            
    
                            </div>
                            <br>


                            
                        <div class="border  p-3">

                      
                            <div class="form-group">
                                <label for="phone1">@lang('main.phone') </label>
                                <input type="text" name="phone2" class="form-control" id="phone2" placeholder="@lang('plachoder.enter_phone')" value="{{ isset($branch->phone2) ? $branch->phone2 :'' }}">
                                @error('phone2')
                                <div class="text-danger">{{ $errors->first('phone2') }}</div>
                                @enderror
                            </div>
        

                        </div>
                        <br>


                        <div class="border  p-3">

                      
                            <div class="form-group">
                                <label for="location">@lang('main.phone') </label>
                                <input type="text" name="location" class="form-control" id="location" placeholder="@lang('plachoder.enter_location')" value="{{ isset($branch->location) ? $branch->location :'' }}">
                                @error('location')
                                <div class="text-danger">{{ $errors->first('location') }}</div>
                                @enderror
                            </div>
        

                        </div>
                        <br>


                        <div class="border  p-3">

                      
                            <div class="form-group">
                                <label for="whatsup">@lang('main.whatsup') </label>
                                <input type="text" name="whatsup" class="form-control" id="whatsup" placeholder="@lang('plachoder.enter_whatsup')" value="{{ isset($branch->whatsup) ? $branch->whatsup :'' }}">
                                @error('whatsup')
                                <div class="text-danger">{{ $errors->first('whatsup') }}</div>
                                @enderror
                            </div>
        

                        </div>
                        <br>
                        

                        <div class="border  p-3">
                            @foreach($langs as $index => $lang)


                                <div class="form-group">
                                    <label for="image">@lang('main.des') ({{$lang->name}})</label>
                                    <textarea name="des[{{$lang->code}}]" class="ckeditor">

                                        @if (isset($branch->translate($lang->code)->des))

                                          {!! $branch->translate($lang->code)->des !!}
                                            
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
                                    <label for="address">@lang('main.des') ({{$lang->name}})</label>
                                    <textarea name="address[{{$lang->code}}]" class="ckeditor">

                                        @if (isset($branch->translate($lang->code)->address))

                                          {!! $branch->translate($lang->code)->address !!}
                                            
                                        @endif
                                    </textarea>

                                    @error('address.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('address.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                        <br>

                    </div>



                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> @lang('main.update') </button>
                    </div>


                </form>
            </div>

        </div>
    </section>
@endsection

