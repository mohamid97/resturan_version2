@extends('front.layout.master')

@section('content')

    <div class="th-hero-wrapper hero-2">
        <div class="hero-slider-2 autoplay" id="heroSlide2">

            @foreach($sliders as $slider)
                <div class="th-hero-slide">
                    <div
                        class="th-hero-bg"
                        data-bg-src="{{asset('uploads/images/sliders/' . $slider->image)}}"
                        data-overlay="black"
                        data-opacity="6"
                    ></div>
                    <div class="container">
                        <div class="hero-style2">
                            <div class="hero-logo">
                                <h2 class="hero-title"> {{$slider->translate(app()->getLocale())->name}}</h2>
                            </div>
                            <p class="hero-text"> {{ $slider->translate(app()->getLocale())->small_des }}    </p>

                        </div>
                    </div>
                </div>
            @endforeach




        </div>




        <div class="slider-nav-wrap">
            <div class="slider-nav">
                <button data-slick-prev="#heroSlide2" class="nav-btn">
                    <i class="fas fa-long-arrow-left"></i>
                </button>
                <div class="custom-dots"></div>
                <button data-slick-next="#heroSlide2" class="nav-btn">
                    <i class="fas fa-long-arrow-right"></i>
                </button>
            </div>
        </div>
        <a href="#about-sec" class="scroll-bottom"></a>
        <div class="curve-shape"></div>
    </div>
    <section class="about-area cards_section pt-30 pb-30 animate__animated animate__bounceInLeft ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-around">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-40">
                        {!! $about->translate(app()->getLocale())->des !!}

                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-right">
                                        @if(isset($des))
                                            <h3>{{$des->translate(app()->getLocale())->name}}</h3>
                                            <p>
                                                {!! $des->translate(app()->getLocale())->des !!}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="align-self-center">
                                        <!-- <i class="fas fa-home primary font-large-2 float-left"></i> -->
                                        <div class="icon">
                                            <img
                                                src="https://www.dcsmasr.com/images/mix_svg/architecture_engineering.svg"
                                                alt=""
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <a href="{{asset('uploads/images/about/' . $about->photo)}}" data-fancybox="">
                        <img src="{{asset('uploads/images/about/' . $about->photo)}}" alt="{{$about->translate(app()->getLocale())->alt_image}}" />
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="space gallery_area">
        <div class="container">
            <div class="row justify-content-lg-between align-items-end">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="title-area">
                        <span class="big-title">م.</span>
                        <h2 class="sec-title">
                            المشاريع <span class="text-transparent">المميزة</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row project-slide2 th-carousel" data-slide-show="2">
                @foreach($our_works as $index => $our_work)
                    <div class="col-md-4">
                        <div class="project-box">
                            <div class="project-img">
                                <img src="{{asset('/uploads/images/ourworks/' .$our_work->photo)}}" alt="{{$our_work->translate(app()->getLocale())->alt_image}}" />
                            </div>
                            <div class="project-content">
                                <div class="project-number">0{{$index + 1}}</div>
                                <h3 class="h5 project-title">
                                    <a href="{{asset('/uploads/images/ourworks/' .$our_work->photo)}}" data-fancybox=""
                                    >  {{$our_work->translate(app()->getLocale())->name}}</a
                                    >
                                </h3>
                                <p class="project-map">
                                    <i class="fas fa-location-dot"></i> {{$our_work->link}}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="text-center mt-5">
                <a href="{{ route('projects') }}" class="link-btn">عرض جميع المشاريع</a>
            </div>
        </div>
    </div>



    @if(isset($category[0]))
    <section class="services_area cards_section bg-white pb-30">
        <div class="section-title text-center">
            <h2>     {{ $category[0]->translate(app()->getLocale())->name }} </h2>
            <p class="animate__bounceInUp">
                {{ $category[0]->translate(app()->getLocale())->small_des }}
            </p>
        </div>




        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                @foreach($category[0]->services as $index => $service)
                <button
                    class="nav-link {{ $index == 0 ? 'active' : '' }}"
                    id="nav-first-category{{$index}}-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#nav-first-category{{$index}}"
                    type="button"
                    role="tab"
                    aria-controls="nav-first-category{{$index}}"
                    aria-selected="true"
                >
                    {{ $service->translate(app()->getLocale())->name }}
                </button>

                @endforeach
            </div>
        </nav>








        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content" id="nav-tabContent">

                        @foreach($category[0]->services as $index => $service)
                        <div
                            class="tab-pane fade show {{ $index == 0 ? 'active' : '' }}"
                            id="nav-first-category{{$index}}"
                            role="tabpanel"
                            aria-labelledby="nav-first-category{{$index}}-tab"
                            tabindex="0"
                        >
                            <div class="row justify-content-around align-items-center">
                                <div class="col-lg-7">
                                    <div class="card text-center">
                                        <div class="card-content">
                                            <div class="card-body" style="padding: 10px 33px 10px !important;">
                                                <div class="media d-flex">
                                                    <div class="media-body text-right">
                                                        {!! $service->translate(app()->getLocale())->des !!}
                                                    </div>
                                                    <div class="align-self-center">
                                                        <!-- <i class="fas fa-home primary font-large-2 float-left"></i> -->
                                                        <div class="icon">
                                                            <img
                                                                src="https://www.dcsmasr.com/images/mix_svg/architecture_engineering.svg"
                                                                alt=""
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <img src="{{asset('uploads/images/service/' .$service->image )}}" alt="{{ $service->translate(app()->getLocale())->alt_image }}" />
                                </div>


                                @if($index == 0)

                                    <div class="col-lg-12">
                                        <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button
                                                        class="accordion-button"
                                                        type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOne"
                                                        aria-expanded="true"
                                                        aria-controls="collapseOne"
                                                    >
                                                        {{ $category[0]->translate(app()->getLocale())->name }}
                                                    </button>
                                                </h2>
                                                <div

                                                    id="collapseOne"
                                                    class="accordion-collapse collapse"
                                                    data-bs-parent="#accordionExample"
                                                >
                                                    <div class="accordion-body" style="padding: 10px 25px !important;">
                                                        <div class="content-box">
                                                            <p>
                                                                {!!  $category[0]->translate(app()->getLocale())->des !!}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endif

                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @if(isset($category[1]))
    <section class="services_area cards_section bg-white pb-30">
        <div class="section-title text-center">
            <h2>     {{ $category[1]->translate(app()->getLocale())->name }} </h2>
            <p class="animate__bounceInUp">
                {{ $category[1]->translate(app()->getLocale())->small_des }}
            </p>
        </div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab-1" role="tablist">

                @foreach($category[1]->services as $index => $service)
                <button
                    class="nav-link {{ $index == 0 ? 'active' : '' }}"
                    id="nav-second-category{{$index}}-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#nav-second-category{{$index}}"
                    type="button"
                    role="tab"
                    aria-controls="nav-second-category{{$index}}"
                    aria-selected="true"
                >
                      {{ $service->translate(app()->getLocale())->name }}
                </button>
                @endforeach

            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content" id="nav-tabContent">
                        @foreach($category[1]->services as $index => $service)
                        <div
                            class="tab-pane fade show {{ $index == 0 ? 'active' : '' }}"
                            id="nav-second-category{{$index}}"
                            role="tabpanel"
                            aria-labelledby="nav-second-category{{$index}}-tab"
                            tabindex="0"
                        >
                            <div class="row justify-content-around align-items-center">
                                <div class="col-lg-7">
                                    <div class="card text-center">
                                        <div class="card-content">
                                            <div class="card-body" style="padding: 10px 33px 10px !important;">
                                                <div class="media d-flex">
                                                    <div class="media-body text-right">
                                                        {!! $service->translate(app()->getLocale())->des !!}
                                                    </div>
                                                    <div class="align-self-center">
                                                        <!-- <i class="fas fa-home primary font-large-2 float-left"></i> -->
                                                        <div class="icon">
                                                            <img
                                                                src="https://www.dcsmasr.com/images/mix_svg/architecture_engineering.svg"
                                                                alt=""
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <img src="{{asset('uploads/images/service/' .$service->image )}}" alt="{{ $service->translate(app()->getLocale())->alt_image }}" />
                                </div>

                                @if($index == 0)
                                    <div class="col-lg-12">
                                        <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header ">
                                                    <button
                                                        class="accordion-button"
                                                        type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOne"
                                                        aria-expanded="true"
                                                        aria-controls="collapseOne"
                                                    >
                                                        {{$category[1]->translate(app()->getLocale())->name}}
                                                    </button>
                                                </h2>
                                                <div
                                                    id="collapseOne"
                                                    class="accordion-collapse collapse"
                                                    data-bs-parent="#accordionExample"
                                                >
                                                    <div class="accordion-body" style="padding: 10px 25px !important;">
                                                        <div class="content-box">
                                                            <p>
                                                                {!! $category[1]->translate(app()->getLocale())->des !!}

                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @if(isset($category[2]))
        <section class="services_area cards_section bg-white pb-30">
            <div class="section-title text-center">
                <h2>     {{ $category[2]->translate(app()->getLocale())->name }} </h2>
                <p class="animate__bounceInRight">
                    {{ $category[2]->translate(app()->getLocale())->small_des }}
                </p>
            </div>
            <nav>
                <div class="nav nav-tabs" id="nav-tab-1" role="tablist">

                    @foreach($category[2]->services as $index => $service)
                        <button
                            class="nav-link {{ $index == 0 ? 'active' : '' }}"
                            id="nav-third-category{{$index}}-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#nav-third-category{{$index}}"
                            type="button"
                            role="tab"
                            aria-controls="nav-third-category{{$index}}"
                            aria-selected="true"
                        >
                            {{ $service->translate(app()->getLocale())->name }}
                        </button>
                    @endforeach

                </div>
            </nav>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content" id="nav-tabContent">
                            @foreach($category[2]->services as $index => $service)
                                <div
                                    class="tab-pane fade show {{ $index == 0 ? 'active' : '' }}"
                                    id="nav-third-category{{$index}}"
                                    role="tabpanel"
                                    aria-labelledby="nav-third-category{{$index}}-tab"
                                    tabindex="0"
                                >
                                    <div class="row justify-content-around align-items-center">
                                        <div class="col-lg-7">
                                            <div class="card text-center">
                                                <div class="card-content">
                                                    <div class="card-body" style="padding: 10px 33px 10px !important;">
                                                        <div class="media d-flex">
                                                            <div class="media-body text-right">
                                                                {!! $service->translate(app()->getLocale())->des !!}
                                                            </div>
                                                            <div class="align-self-center">
                                                                <!-- <i class="fas fa-home primary font-large-2 float-left"></i> -->
                                                                <div class="icon">
                                                                    <img
                                                                        src="https://www.dcsmasr.com/images/mix_svg/architecture_engineering.svg"
                                                                        alt=""
                                                                    />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <img src="{{asset('uploads/images/service/' .$service->image )}}" alt="{{ $service->translate(app()->getLocale())->alt_image }}" />
                                        </div>

                                        @if($index == 0)
                                            <div class="col-lg-12">
                                                <div class="accordion" id="accordionExample">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header">
                                                            <button
                                                                class="accordion-button"
                                                                type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseOne"
                                                                aria-expanded="true"
                                                                aria-controls="collapseOne"
                                                            >
                                                                {{$category[2]->translate(app()->getLocale())->name}}
                                                            </button>
                                                        </h2>
                                                        <div
                                                            id="collapseOne"
                                                            class="accordion-collapse collapse"
                                                            data-bs-parent="#accordionExample"
                                                        >
                                                            <div class="accordion-body" style="padding: 10px 25px !important;" >
                                                                <div class="content-box">
                                                                    <p>
                                                                        {!! $category[2]->translate(app()->getLocale())->des !!}

                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif





    @if(isset($category[3]))
    <section class="services_area cards_section bg-white pb-30">
        <div class="section-title text-center">
            <h2>     {{ $category[3]->translate(app()->getLocale())->name }} </h2>
            <p class="animate__bounceInRight">
                {{ $category[3]->translate(app()->getLocale())->small_des }}
            </p>
        </div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab-1" role="tablist">

                @foreach($category[3]->services as $index => $service)
                    <button
                        class="nav-link {{ $index == 0 ? 'active' : '' }}"
                        id="nav-third-category{{$index}}-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-third-category{{$index}}"
                        type="button"
                        role="tab"
                        aria-controls="nav-third-category{{$index}}"
                        aria-selected="true"
                    >
                        {{ $service->translate(app()->getLocale())->name }}
                    </button>
                @endforeach

            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content" id="nav-tabContent">
                        @foreach($category[3]->services as $index => $service)
                            <div
                                class="tab-pane fade show {{ $index == 0 ? 'active' : '' }}"
                                id="nav-third-category{{$index}}"
                                role="tabpanel"
                                aria-labelledby="nav-third-category{{$index}}-tab"
                                tabindex="0"
                            >
                                <div class="row justify-content-around align-items-center">
                                    <div class="col-lg-7">
                                        <div class="card text-center">
                                            <div class="card-content">
                                                <div class="card-body" style="padding: 10px 33px 10px !important;">
                                                    <div class="media d-flex">
                                                        <div class="media-body text-right">
                                                            {!! $service->translate(app()->getLocale())->des !!}
                                                        </div>
                                                        <div class="align-self-center">
                                                            <!-- <i class="fas fa-home primary font-large-2 float-left"></i> -->
                                                            <div class="icon">
                                                                <img
                                                                    src="https://www.dcsmasr.com/images/mix_svg/architecture_engineering.svg"
                                                                    alt=""
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <img src="{{asset('uploads/images/service/' .$service->image )}}" alt="{{ $service->translate(app()->getLocale())->alt_image }}" />
                                    </div>

                                    @if($index == 0)
                                        <div class="col-lg-12">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button
                                                            class="accordion-button"
                                                            type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne"
                                                            aria-expanded="true"
                                                            aria-controls="collapseOne"
                                                        >
                                                            {{$category[3]->translate(app()->getLocale())->name}}
                                                        </button>
                                                    </h2>
                                                    <div
                                                        id="collapseOne"
                                                        class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionExample"
                                                    >
                                                        <div class="accordion-body" style="padding: 10px 25px !important;">
                                                            <div class="content-box">
                                                                <p>
                                                                    {!! $category[3]->translate(app()->getLocale())->des !!}

                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endif







    <section class="counter_area pt-60 pb-30">
        <div class="container-fluid custom-container">
            <div class="section-title text-center">
                <p>خبرة قوية في السوق المصرية</p>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="counter-count">
                        <h2 class="count counter" data-speed="50000">{{$achievement->number_of_deps }}</h2>
                        <p class="title">
                            سبع إدارات متخصصة لمراجعه ومراقبة جودة التشطيب
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="counter-count">
                        <h2 class="count counter" data-speed="50000">{{$achievement->number_of_clients }}</h2>
                        <p class="title">أكثر من 99 منطقة وكمبوند إستقبلت طاقم عملنا</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="counter-count">
                        <h2 class="count counter" data-speed="50000">1279</h2>
                        <p class="title">مراعاته</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="counter-count">
                        <h2 class="count">1</h2>
                        <p class="title">الشركة الأولي في التشطيبات المعمارية في مصر</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="counter-count">
                        <h2 class="count counter" data-speed="50000">{{$achievement->years_exp }}</h2>
                        <p class="title">أكثر من 15 عام خبره بالسوق المصريه</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="counter-count">
                        <h2 class="count  counter" data-speed="50000">{{$achievement->num1 }}</h2>
                        <p class="title">أكثر من 500 تصميم جاهز وموفر للإختيار منهم</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="counter-social-links">
                        <ul class="clearfix">
                            @if($social->facebook_option)
                            <li class="facebook">
                                <a href="{{$social->facebook}}"
                                ><span class="fab fa-facebook-square"></span
                                    ></a>
                            </li>
                            @endif
                            @if($social->email)
                                <li class="envelope">
                                    <a href="mailto:{{$social->email}}"
                                    ><span class="fas fa-envelope"></span
                                        ></a>
                                </li>
                            @endif

                            @if($social->whatsup_option)
                                <li class="whatsapp">
                                    <a href="https://wa.me/{{$social->whatsup}}"
                                    ><span class="fab fa-whatsapp"></span
                                        ></a>
                                </li>
                            @endif

{{--                            @if($social->whatsup_option)--}}
{{--                                <li class="support">--}}
{{--                                    <a href="javascript:void(0);"--}}
{{--                                    ><span class="fas fa-comments"></span--}}
{{--                                        ></a>--}}
{{--                                </li>--}}
{{--                            @endif--}}

{{--                            @if($social->whatsup_option)--}}
{{--                                <li class="support-2">--}}
{{--                                    <a href="ask-price.html"--}}
{{--                                    ><span class="fas fa-headset"></span--}}
{{--                                        ></a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
                            @if($social->phone_option)
                                <li class="facebook">
                                    <a href="tel:{{$social->phone}}"
                                    ><span class="fas fa-phone"></span
                                        ></a>
                                </li>
                            @endif

                            @if($social->instagram_option)
                                <li class="instagram">
                                    <a href="{{$social->instagram}}"
                                    ><span class="fab fa-instagram"></span
                                        ></a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="call_us_area pt-40 pb-40 bg-white">
        <div class="container-fluid custom-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box-contact text-center">
                        <div class="section-title">
                            <p class="animate__fadeInBottomLeft">هل تريد معرفة أسعار التشطيب الاَن؟</p>
                        </div>
                        <h1>إتصل الاَن</h1>
                    </div>
                    <div class="box-info animate__fadeInBottomLeft">
                        <p>
                            كل وحدة سكنية حالة خاصة ويتم تصميمها طبقاً لميزانية العميل
                            وطبيعة الديكور، لذا نأسف لعدم إحتسابها بالمتر المربع كما يخطىء
                            البعض، إتصل الاَن وتعرف علي أحدث قوائم الأسعار والمقايسات
                            الإسترشادية.
                        </p>
                        <p>
                            تشمل خدماتنا تصميم وتنفيذ كافة أعمال التشطيبات الداخلية
                            والخارجية لكافة أنماط الوحدات السكنية المختلفة.
                        </p>
                        <p>
                            تشمل خدماتنا كافة أعمال اللاندسكيب وحمامات السباحة والمصاعد.
                        </p>
                        <p>
                            تشمل خدماتنا كافة أعمال المنازل الذكية "SMART HOME AUTOMATION"
                            وكافة حلول الإتصالات والتأمين والمراقبة.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="proccess_area pt-20">
        <div class="section-title text-center">
            <h2>أقسامنا </h2>
        </div>
        <div class="container">
            <div class="row">

                @foreach($category as $index => $cat)
                    <div class="col-lg-12">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button
                                        class="accordion-button"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne{{$index}}"
                                        aria-expanded="true"
                                        aria-controls="collapseOne{{$index}}"
                                    >
                                       {{ $cat->translate(app()->getLocale())->name }}
                                    </button>
                                </h2>
                                <div
                                    id="collapseOne{{$index}}"
                                    class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample"
                                >
                                    <div class="accordion-body">
                                        <div class="content-box">
                                            <p>
                                                {!! $cat->translate(app()->getLocale())->des !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>

    <div class="space">
        <div class="container">
            <div class="row justify-content-lg-between align-items-end">
                <div class="col-lg-9 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="title-area">
                        <span class="big-title">ش.</span>
                        <h2 class="sec-title">
                            نتعاون مع شركات <span class="text-transparent">التمويل</span>
                        </h2>
                    </div>
                </div>
                <div class="col-auto wow fadeInUp" data-wow-delay="0.2s">
                    <div class="sec-btn">
                        <div class="icon-box style2">
                            <button
                                data-slick-prev="#brandSlide1"
                                class="slick-arrow default"
                            >
                                <i class="fas fa-long-arrow-left"></i>
                            </button>
                            <button
                                data-slick-next="#brandSlide1"
                                class="slick-arrow default"
                            >
                                <i class="fas fa-long-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="brand-img-wrap">
                <div
                    class="row brands_logo"
                    id="brandSlide1"
                    data-slide-show="4"
                    data-lg-slide-show="3"
                    data-md-slide-show="2"
                    data-sm-slide-show="2"
                >



                    @foreach ($clients as $client )


                    <div
                        class="col-sm-6 col-lg-auto wow fadeInUp"
                        data-wow-delay="0.2s"
                    >
                        <div class="brand-img">
                            <img src="{{ asset('uploads/images/clients/' . $client->icon) }}" alt="{{ $client->name }}" />
                        </div>
                    </div>


                    @endforeach

                </div>
            </div>
        </div>
    </div>




@endsection


@section('scripts')
<script>

(() => {
    const counter = document.querySelectorAll('.counter');
    // covert to array
    const array = Array.from(counter);
    // select array element
    array.map((item) => {
        // data layer
        let counterInnerText = item.textContent;

        let count = 1;
        let speed = item.dataset.speed / counterInnerText
        function counterUp() {
            item.textContent = count++
            if (counterInnerText < count) {
                clearInterval(stop);
            }
        }
        const stop = setInterval(() => {
            counterUp();
        }, speed);
    })
})()

</script>

@endsection