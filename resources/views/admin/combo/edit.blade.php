@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.edit_extra')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.edit_combo')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.combos')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.combo.update' , ['id'=> $combo->id]) }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">
                        <div class="border  p-3">

                        @foreach($langs as $lang)
                            <div class="form-group">
                                <label for="name">@lang('main.name') ({{ $lang->name }}) </label>
                                <input type="text" name="name[{{$lang->code}}]" class="form-control" id="name" placeholder="@lang('plachoder.enter_name')" value="{{ isset($combo->translate($lang->code)->name) ? $combo->translate($lang->code)->name :''}}">
                                @error('name.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('name.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach

                        </div>

                        <br>


                        <div class="border  p-3">

                      
                                <div class="form-group">
                                    <label for="price">@lang('main.price') </label>
                                    <input type="text" name="price" class="form-control" id="extra" placeholder="@lang('plachoder.enter_price')" value="{{ isset($combo->price) ? $combo->price :'' }}">
                                    @error('price')
                                    <div class="text-danger">{{ $errors->first('price') }}</div>
                                    @enderror
                                </div>
            
    
                            </div>
                            <br>






                        

                        <div class="border  p-3">
                            @foreach($langs as $index => $lang)


                                <div class="form-group">
                                    <label for="image">@lang('main.des') ({{$lang->name}})</label>
                                    <textarea name="des[{{$lang->code}}]" class="ckeditor">

                                        @if (isset($combo->translate($lang->code)->des))

                                          {!! $combo->translate($lang->code)->des !!}
                                            
                                        @endif
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
                            <img src="{{asset('uploads/images/combos/'. $combo->photo)}}" width="150px" height="150px">

                            @error('photo')
                            <div class="text-danger">{{ $errors->first('photo') }}</div>
                            @enderror
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

