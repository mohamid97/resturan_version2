@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.edit_type')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.edit_type')</li>
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
                <form role="form" method="post" action="{{route('admin.types.update' , ['id'=> $type->id]) }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">
                        <div class="border  p-3">

                        @foreach($langs as $lang)
                            <div class="form-group">
                                <label for="name">@lang('main.name') ({{ $lang->name }}) </label>
                                <input type="text" name="name[{{$lang->code}}]" class="form-control" id="name" placeholder="@lang('plachoder.enter_name')" value="{{ isset($type->translate($lang->code)->name) ? $type->translate($lang->code)->name :''}}">
                                @error('name.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('name.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach

                        </div>

                        <br>


                        <div class="border  p-3">

                      
                                <div class="form-group">
                                    <label for="small_des">@lang('main.small_des') </label>
                                    <input type="text" name="small_des" class="form-control" id="small_des" placeholder="@lang('plachoder.enter_small_des')" value="{{ isset($type->small_des) ? $type->small_des :'' }}">
                                    @error('small_des')
                                    <div class="text-danger">{{ $errors->first('small_des') }}</div>
                                    @enderror
                                </div>
            
    
                            </div>
                            <br>






                        

                        <div class="border  p-3">
                            @foreach($langs as $index => $lang)


                                <div class="form-group">
                                    <label for="image">@lang('main.des') ({{$lang->name}})</label>
                                    <textarea name="des[{{$lang->code}}]" class="ckeditor">

                                        @if (isset($type->translate($lang->code)->des))

                                          {!! $type->translate($lang->code)->des !!}
                                            
                                        @endif
                                    </textarea>

                                    @error('des.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('des.' . $lang->code) }}</div>
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

