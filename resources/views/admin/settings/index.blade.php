@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Settings </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                @if($settings->finish != 1)
                    <p class="alert alert-danger" style="text-align: center"> من فضلك قم بتحديد لغات الموقع قبل ضبط الإعدادت في البدايه</p>

                @endif

                <div class="card-header">
                    <h3 class="card-title">Settings</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.settings.update') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">


                        @foreach($langs as $lang)
                        <div class="form-group">
                            <label for="working_hours">Working Hours ({{ $lang->name }}) </label>
                            <input type="text" name="working_hours[{{$lang->code}}]" class="form-control" id="working_hours" placeholder="" value=" {{isset($settings->translate($lang->code)->working_hours) ? $settings->translate($lang->code)->working_hours :''}} ">
                            @error('working_hours.' . $lang->code)
                            <div class="text-danger">{{ $errors->first('working_hours.' . $lang->code) }}</div>
                            @enderror
                        </div>
                       @endforeach




                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="logo" type="file" class="custom-file-input" id="logo">
                                    <label class="custom-file-label" for="logo">Choose Logo</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/setting/'. $settings->logo)}}" width="150px" height="150px">


                            @error('logo')
                            <div class="text-danger">{{ $errors->first('logo') }}</div>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="Favicon">Favicon</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="favicon" type="file" class="custom-file-input" id="Favicon">
                                    <label class="custom-file-label" for="Favicon">Choose Favicon</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/setting/'. $settings->favicon)}}" width="150px" height="150px">
                            @error('favicon')
                            <div class="text-danger">{{ $errors->first('favicon') }}</div>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="home_breadcrumb_background">Home Breadcrumb Background</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="home_breadcrumb_background" type="file" class="custom-file-input" id="home_breadcrumb_background">
                                    <label class="custom-file-label" for="home_breadcrumb_background">Choose Background</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/setting/'. $settings->home_breadcrumb_background)}}" width="150px" height="150px">


                            @error('home_breadcrumb_background')
                            <div class="text-danger">{{ $errors->first('home_breadcrumb_background') }}</div>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="about_breadcrumb_background">About Breadcrumb Background</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="about_breadcrumb_background" type="file" class="custom-file-input" id="about_breadcrumb_background">
                                    <label class="custom-file-label" for="about_breadcrumb_background">Choose Background</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/setting/'. $settings->about_breadcrumb_background)}}" width="150px" height="150px">

                            @error('about_breadcrumb_background')
                            <div class="text-danger">{{ $errors->first('about_breadcrumb_background') }}</div>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="contact_breadcrumb_background">Contact Breadcrumb Background</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="contact_breadcrumb_background" type="file" class="custom-file-input" id="contact_breadcrumb_background">
                                    <label class="custom-file-label" for="contact_breadcrumb_background">Choose Background</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/setting/'. $settings->contact_breadcrumb_background)}}" width="150px" height="150px">

                            @error('contact_breadcrumb_background')
                            <div class="text-danger">{{ $errors->first('contact_breadcrumb_background') }}</div>
                            @enderror
                        </div>




                        <div class="form-group">
                            <label for="products_breadcrumb_background">Products Breadcrumb Background</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="products_breadcrumb_background" type="file" class="custom-file-input" id="products_breadcrumb_background">
                                    <label class="custom-file-label" for="products_breadcrumb_background">Choose Background</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/setting/'. $settings->products_breadcrumb_background)}}" width="150px" height="150px">

                            @error('products_breadcrumb_background')
                            <div class="text-danger">{{ $errors->first('products_breadcrumb_background') }}</div>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="categories_breadcrumb_background">Categories Breadcrumb Background</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="categories_breadcrumb_background" type="file" class="custom-file-input" id="categories_breadcrumb_background">
                                    <label class="custom-file-label" for="categories_breadcrumb_background">Choose Background</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/setting/'. $settings->categories_breadcrumb_background)}}" width="150px" height="150px">

                            @error('categories_breadcrumb_background')
                            <div class="text-danger">{{ $errors->first('categories_breadcrumb_background') }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="category_details_breadcrumb_background">Category Details Breadcrumb Background</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="category_details_breadcrumb_background" type="file" class="custom-file-input" id="category_details_breadcrumb_background">
                                    <label class="custom-file-label" for="category_details_breadcrumb_background">Choose Background</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/setting/'. $settings->category_details_breadcrumb_background)}}" width="150px" height="150px">

                            @error('category_details_breadcrumb_background')
                            <div class="text-danger">{{ $errors->first('category_details_breadcrumb_background') }}</div>
                            @enderror
                        </div>




                        <div class="form-group">
                            <label for="services_breadcrumb_background">Services Breadcrumb Background</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="services_breadcrumb_background" type="file" class="custom-file-input" id="services_breadcrumb_background">
                                    <label class="custom-file-label" for="services_breadcrumb_background">Choose Background</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/setting/'. $settings->services_breadcrumb_background)}}" width="150px" height="150px">

                            @error('services_breadcrumb_background')
                            <div class="text-danger">{{ $errors->first('services_breadcrumb_background') }}</div>
                            @enderror
                        </div>




                        <div class="form-group">
                            <label for="service_details_breadcrumb_background">Service Details Breadcrumb Background</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="service_details_breadcrumb_background" type="file" class="custom-file-input" id="service_details_breadcrumb_background">
                                    <label class="custom-file-label" for="service_details_breadcrumb_background">Choose Background</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/setting/'. $settings->service_details_breadcrumb_background)}}" width="150px" height="150px">

                            @error('service_details_breadcrumb_background')
                            <div class="text-danger">{{ $errors->first('service_details_breadcrumb_background') }}</div>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="our_work_breadcrumb_background">Prjects Breadcrumb Background</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="our_work_breadcrumb_background" type="file" class="custom-file-input" id="our_work_breadcrumb_background">
                                    <label class="custom-file-label" for="our_work_breadcrumb_background">Choose Background</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/setting/'. $settings->our_work_breadcrumb_background)}}" width="150px" height="150px">

                            @error('our_work_breadcrumb_background')
                            <div class="text-danger">{{ $errors->first('our_work_breadcrumb_background') }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="our_work_breadcrumb_background">Blog Breadcrumb Background</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="blog_breadcrumb_background" type="file" class="custom-file-input" id="blog_breadcrumb_background">
                                    <label class="custom-file-label" for="blog_breadcrumb_background">Choose Background</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/setting/'. $settings->blog_breadcrumb_background)}}" width="150px" height="150px">

                            @error('blog_breadcrumb_background')
                            <div class="text-danger">{{ $errors->first('blog_breadcrumb_background') }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="our_work_breadcrumb_background">Blog Details Breadcrumb Background</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="blog_details_breadcrumb_background" type="file" class="custom-file-input" id="blog_details_breadcrumb_background">
                                    <label class="custom-file-label" for="blog_details_breadcrumb_background">Choose Background</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/setting/'. $settings->blog_details_breadcrumb_background)}}" width="150px" height="150px">

                            @error('blog_details_breadcrumb_background')
                            <div class="text-danger">{{ $errors->first('blog_details_breadcrumb_background') }}</div>
                            @enderror
                        </div>












                        @foreach($langs as $lang)
                            <div class="form-group">
                                <label for="website_name">Website Name ({{ $lang->name }}) </label>
                                <input type="text" name="website_name[{{$lang->code}}]" class="form-control" id="website_name" placeholder="Enter Website Name" value=" {{$settings->translate($langs[0]->code)->website_name}} ">
                                @error('website_name.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('website_name.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach




                        @foreach($langs as $lang)
                            <div class="form-group">
                                <label for="website_des">Website Description ({{ $lang->name }}) </label>
                                <input type="text" name="website_des[{{$lang->code}}]" class="form-control" id="website_des" placeholder="Enter Website Description" value="{{$settings->translate($langs[0]->code)->website_des}}">
                                @error('website_des.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('website_des.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach


                        <h3> Tabs </h3>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                   <lable>Show/Hide - Sliders</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->slider ?'checked':'')}} name="slider" type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1"></label>
                                    </div>
                                </div>
                            </div>
                            @error('slider')
                            <div class="text-danger">{{ $errors->first('slider') }}</div>
                            @enderror
                        </div>


                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - About Us</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->about_us ?'checked':'')}} name="about_us" type="checkbox" class="custom-control-input" id="customCheck2">
                                        <label class="custom-control-label" for="customCheck2"></label>
                                    </div>
                                </div>
                            </div>
                            @error('about_us')
                            <div class="text-danger">{{ $errors->first('about_us') }}</div>
                            @enderror
                        </div>



                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Mission Vission</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->mission_vission ?'checked':'')}} name="mission_vission" type="checkbox" class="custom-control-input" id="customCheck002">
                                        <label class="custom-control-label" for="customCheck002"></label>
                                    </div>
                                </div>
                            </div>
                            @error('mission_vission')
                            <div class="text-danger">{{ $errors->first('mission_vission') }}</div>
                            @enderror
                        </div>





                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Offers</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->offers ?'checked':'')}} name="offers" type="checkbox" class="custom-control-input" id="customCheck0021">
                                        <label class="custom-control-label" for="customCheck0021"></label>
                                    </div>
                                </div>
                            </div>
                            @error('offers')
                            <div class="text-danger">{{ $errors->first('offers') }}</div>
                            @enderror
                        </div>


                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Points</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->points ?'checked':'')}} name="points" type="checkbox" class="custom-control-input" id="customCheck0021points">
                                        <label class="custom-control-label" for="customCheck0021points"></label>
                                    </div>
                                </div>
                            </div>
                            @error('points')
                            <div class="text-danger">{{ $errors->first('points') }}</div>
                            @enderror
                        </div>


                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Coupons</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->coupons ?'checked':'')}} name="coupons" type="checkbox" class="custom-control-input" id="customCheck0021coupons">
                                        <label class="custom-control-label" for="customCheck0021coupons"></label>
                                    </div>
                                </div>
                            </div>
                            @error('coupons')
                            <div class="text-danger">{{ $errors->first('coupons') }}</div>
                            @enderror
                        </div>


                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Types</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->types ?'checked':'')}} name="types" type="checkbox" class="custom-control-input" id="customCheck0021types">
                                        <label class="custom-control-label" for="customCheck0021types"></label>
                                    </div>
                                </div>
                            </div>
                            @error('types')
                            <div class="text-danger">{{ $errors->first('types') }}</div>
                            @enderror
                        </div>



                        
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Extras</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->extras ?'checked':'')}} name="extras" type="checkbox" class="custom-control-input" id="customCextras">
                                        <label class="custom-control-label" for="customCextras"></label>
                                    </div>
                                </div>
                            </div>
                            @error('extras')
                            <div class="text-danger">{{ $errors->first('extras') }}</div>
                            @enderror
                        </div>



                        

                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - combos </lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->combos ?'checked':'')}} name="combos" type="checkbox" class="custom-control-input" id="customcombos">
                                        <label class="custom-control-label" for="customcombos"></label>
                                    </div>
                                </div>
                            </div>
                            @error('combos')
                            <div class="text-danger">{{ $errors->first('combos') }}</div>
                            @enderror
                        </div>

                        
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Branches </lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->branches ?'checked':'')}} name="branches" type="checkbox" class="custom-control-input" id="branches">
                                        <label class="custom-control-label" for="branches"></label>
                                    </div>
                                </div>
                            </div>
                            @error('branches')
                            <div class="text-danger">{{ $errors->first('branches') }}</div>
                            @enderror
                        </div>


                        

                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Carts</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->carts ?'checked':'')}} name="carts" type="checkbox" class="custom-control-input" id="customCheck002_1">
                                        <label class="custom-control-label" for="customCheck002_1"></label>
                                    </div>
                                </div>
                            </div>
                            @error('carts')
                            <div class="text-danger">{{ $errors->first('carts') }}</div>
                            @enderror
                        </div>



                        
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Orders</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->orders ?'checked':'')}} name="orders" type="checkbox" class="custom-control-input" id="customCheck1002_1">
                                        <label class="custom-control-label" for="customCheck1002_1"></label>
                                    </div>
                                </div>
                            </div>
                            @error('orders')
                            <div class="text-danger">{{ $errors->first('orders') }}</div>
                            @enderror
                        </div>




                        

                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - City Price</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->city_price ?'checked':'')}} name="city_price" type="checkbox" class="custom-control-input" id="customCheck002_10">
                                        <label class="custom-control-label" for="customCheck002_10"></label>
                                    </div>
                                </div>
                            </div>
                            @error('carts')
                            <div class="text-danger">{{ $errors->first('carts') }}</div>
                            @enderror
                        </div>







                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide -  Messages </lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->messages ?'checked':'')}} name="messages" type="checkbox" class="custom-control-input" id="customCheck00">
                                        <label class="custom-control-label" for="customCheck00"></label>
                                    </div>
                                </div>
                            </div>
                            @error('messages')
                            <div class="text-danger">{{ $errors->first('messages') }}</div>
                            @enderror
                        </div>


                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide -  Payments </lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->payments ?'checked':'')}} name="payments" type="checkbox" class="custom-control-input" id="customCheck010">
                                        <label class="custom-control-label" for="customCheck010"></label>
                                    </div>
                                </div>
                            </div>
                            @error('messages')
                            <div class="text-danger">{{ $errors->first('messages') }}</div>
                            @enderror
                        </div>







                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Contact Us</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->contact_us ?'checked':'')}} name="contact_us" type="checkbox" class="custom-control-input" id="customCheck3">
                                        <label class="custom-control-label" for="customCheck3"></label>
                                    </div>
                                </div>
                            </div>
                            @error('contact_us')
                            <div class="text-danger">{{ $errors->first('contact_us') }}</div>
                            @enderror
                        </div>




                        
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide -FAQ</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->faq ?'checked':'')}} name="faq" type="checkbox" class="custom-control-input" id="customCheck003">
                                        <label class="custom-control-label" for="customCheck003"></label>
                                    </div>
                                </div>
                            </div>
                            @error('faq')
                            <div class="text-danger">{{ $errors->first('faq') }}</div>
                            @enderror
                        </div>







                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Social Media</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->social_media ?'checked':'')}} name="social_media" type="checkbox" class="custom-control-input" id="customCheck4">
                                        <label class="custom-control-label" for="customCheck4"></label>
                                    </div>
                                </div>
                            </div>
                            @error('social_media')
                            <div class="text-danger">{{ $errors->first('social_media') }}</div>
                            @enderror
                        </div>


                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Clients </lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->clients ?'checked':'')}} name="clients" type="checkbox" class="custom-control-input" id="customCheck5">
                                        <label class="custom-control-label" for="customCheck5"></label>
                                    </div>
                                </div>
                            </div>
                            @error('clients')
                            <div class="text-danger">{{ $errors->first('clients') }}</div>
                            @enderror
                        </div>




                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Feedbacks </lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->feedback ?'checked':'')}} name="feedback" type="checkbox" class="custom-control-input" id="feedback5">
                                        <label class="custom-control-label" for="feedback5"></label>
                                    </div>
                                </div>
                            </div>
                            @error('feedback')
                            <div class="text-danger">{{ $errors->first('feedback') }}</div>
                            @enderror
                        </div>





                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Our works</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->our_works ?'checked':'')}} name="our_works" type="checkbox" class="custom-control-input" id="customCheck6">
                                        <label class="custom-control-label" for="customCheck6"></label>
                                    </div>
                                </div>
                            </div>
                            @error('our_works')
                            <div class="text-danger">{{ $errors->first('our_works') }}</div>
                            @enderror
                        </div>



                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Categories</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->categories ?'checked':'')}} name="categories" type="checkbox" class="custom-control-input" id="customCheck7">
                                        <label class="custom-control-label" for="customCheck7"></label>
                                    </div>
                                </div>
                            </div>
                            @error('categories')
                            <div class="text-danger">{{ $errors->first('categories') }}</div>
                            @enderror
                        </div>


                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Products </lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->products ?'checked':'')}} name="products" type="checkbox" class="custom-control-input" id="customCheck8">
                                        <label class="custom-control-label" for="customCheck8"></label>
                                    </div>
                                </div>
                            </div>
                            @error('products')
                            <div class="text-danger">{{ $errors->first('products') }}</div>
                            @enderror
                        </div>



                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Services</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->services ?'checked':'')}} name="services" type="checkbox" class="custom-control-input" id="customCheck9">
                                        <label class="custom-control-label" for="customCheck9"></label>
                                    </div>
                                </div>
                            </div>
                            @error('services')
                            <div class="text-danger">{{ $errors->first('services') }}</div>
                            @enderror
                        </div>



                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Blog</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->cms ?'checked':'')}} name="cms" type="checkbox" class="custom-control-input" id="customCheck10">
                                        <label class="custom-control-label" for="customCheck10"></label>
                                    </div>
                                </div>
                            </div>
                            @error('cms')
                            <div class="text-danger">{{ $errors->first('cms') }}</div>
                            @enderror
                        </div>




                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Media</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->media ?'checked':'')}} name="media" type="checkbox" class="custom-control-input" id="customCheck11">
                                        <label class="custom-control-label" for="customCheck11"></label>
                                    </div>
                                </div>
                            </div>
                            @error('media')
                            <div class="text-danger">{{ $errors->first('media') }}</div>
                            @enderror
                        </div>



                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Description</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->des ?'checked':'')}} name="des" type="checkbox" class="custom-control-input" id="customCheck44">
                                        <label class="custom-control-label" for="customCheck44"></label>
                                    </div>
                                </div>
                            </div>
                            @error('des')
                            <div class="text-danger">{{ $errors->first('des') }}</div>
                            @enderror
                        </div>

                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-8">
                                    <lable>Show/Hide - Achievement</lable>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input {{($settings->achievement ?'checked':'')}} name="achievement" type="checkbox" class="custom-control-input" id="customCheck45">
                                        <label class="custom-control-label" for="customCheck45"></label>
                                    </div>
                                </div>
                            </div>
                            @error('achievement')
                            <div class="text-danger">{{ $errors->first('achievement') }}</div>
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


