@extends('admin.layout.master')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('sidebar.add_type')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('main.home')</a></li>
                        <li class="breadcrumb-item active">@lang('sidebar.add_type_option') </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('sidebar.options')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.types.type_options.store') }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">

                        

                       

                        <div class="form-group">
                            <label>Types</label>
                            <select type="text" name="type_id" class="form-control">
                                <option value="0">@lang('main.select_type')</option>
                                @forelse($types as $type)
                                    <option value="{{$type->id}}">{{$type->translate(app()->getLocale())->name}} / {{ $type->small_des }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('type_id')
                            <div class="text-danger">{{ $errors->first('type_id') }}</div>
                            @enderror
                        </div>





                        <div class="form-group">
                            <label>@lang('main.default')</label>
                            <select type="text" name="default" class="form-control" id="default">
                                <option value="0" selected> @lang('main.no')</option>
                                <option value="1">@lang('main.yes')</option>
                            </select>
                            @error('default')
                            <div class="text-danger">{{ $errors->first('default') }}</div>
                            @enderror
                        </div>


                        
                        <div class="border p-3" id="price-container">
                            <div class="form-group">
                                <label for="price">@lang('main.price')</label>
                                <input type="text" name="price" class="form-control" id="price" placeholder="@lang('plachoder.enter_price')" value="{{ old('price') }}">
                                @error('price')
                                <div class="text-danger">{{ $errors->first('price') }}</div>
                                @enderror
                            </div>
                        </div>

                        
<br>






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
                                <label for="des">@lang('main.des') ({{$lang->name}})</label>
                                <textarea name="des[{{$lang->code}}]" class="ckeditor">

                                </textarea>

                                @error('des.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('des.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach

                    </div>



                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> @lang('main.submit')</button>
                    </div>


                </form>
            </div>

        </div>
    </section>
@endsection

@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const defaultSelect = document.getElementById('default');
        const priceContainer = document.getElementById('price-container');

        // Function to toggle visibility of price input
        function togglePriceField() {
            if (defaultSelect.value == "1") { // "No" is selected
                priceContainer.style.display = 'none';
            } else { // "Yes" is selected
                priceContainer.style.display = 'block';
            }
        }

        // Initial check on page load
        togglePriceField();

        // Listen for changes in the select field
        defaultSelect.addEventListener('change', togglePriceField);
    });
</script>

@endsection
