@extends('front.layout.master')

@section('content')
    <div class="breadcumb-wrapper background-image"
        style="background-image: url({{ asset('uploads/images/setting/' .$settings->about_breadcrumb_background) }});">
        <h1 class="breadcumb-title">من نحن</h1>
        <ul class="breadcumb-menu">
            <li><a href="index.html">الرئيسية</a></li>
            <li>من نحن</li>
        </ul>
    </div>

    <section class="space" id="about-sec">
        <div class="container">
            <div class="row flex-row-reverse justify-content-between">
                <div class="col-xl-4 col-lg-4 mb-5 mb-xl-0 wow fadeInRight">
                    <div class="img-box2">
                        <div class="img1"><img src="{{asset('front/img/logo.png')}}" alt="shape"></div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-8 mt-lg-5 wow fadeInUp"><span class="h5 text-theme mb-25">من نحن</span>
                    <h2 class="sec-titile lt-2 mb-35">{{ $about->translate(app()->getLocale())->name }} </h2>
                    <p class="mb-30">
                        {!! $about->translate(app()->getLocale())->des !!}

                    </p>
                </div>
            </div>
            <div class="row flex-row-reverse align-items-center">
                <div class="col-xxl-6 col-xl-5 wow fadeInUp">
                    <div class="pe-xl-5"><img class="w-100" src="{{ asset('uploads/images/about/'.$about->photo) }}" alt="{{ $about->translate(app()->getLocale())->alt_image }}"></div>
                </div>
                <div class="col-xxl-6 col-xl-7 wow fadeInUp">
                    <div class="experience-card"><span class="year background-image" style="background-image: url({{ asset('uploads/images/static/1.png') }});">7</span>
                        <div class="content">
                            <h3 class="title">سنوات</h3>
                            <h4 class="title2">خبرة</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
