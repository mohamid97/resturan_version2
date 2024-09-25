<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    @if (isset($meta))
         <title>الماسه</title>
        <meta name="description" content="{!! $meta->meta_des !!}">
        <meta name="title" content="{!! $meta->meta_title !!}">
        <meta name="keywords" content="{!! $meta->meta_keywords !!}">
        <meta name="author" content="{!! $meta->author !!}">

    @elseif(isset($seo))

        <title> {!! strip_tags($seo['meta_title']) !!} | الماسه</title>
        <meta name="description" content="{!! $seo['meta_des'] !!}">
        <meta name="title" content="{!! $seo['meta_title'] !!}">
    
    @else
     <title>الماسه</title>
     <meta name="description" content="عميلنا هو محترف في مجال تصميم الديكور الداخلي، حيث يتمتع بخبرة واسعة في خلق تجارب بصرية استثنائية داخل المساحات. يتميز بالقدرة على تحويل الأماكن إلى بيئات فريدة وجميلة، مع التركيز على توفير حلول تصميم تجمع بين الأناقة والوظائف العملية. يسعى العميل لتحقيق رؤية فريدة لكل مشروع، مما يجعله متميزًا في عالم تصميم الديكور الداخلي. "/>

    @endif
    <link
    rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}" />

</head>
<body>
    @include('sweetalert::alert')
<div class="th-menu-wrapper">
    <div class="th-menu-area text-center">
        <button class="th-menu-toggle"><i class="fas fa-times"></i></button>
        <div class="mobile-logo">
            <a href="{{url(route('home'))}}">
                <img src="{{asset('front/img/logo.png')}}" alt="الماسة" />
            </a>
        </div>
        <div class="th-mobile-menu">
            <ul>
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li><a href="{{ route('about') }}">من نحن</a></li>
                <li class="menu-item-has-children">
                    <a href="{{ route('services') }}">الخدمات</a>
                </li>
                <li><a href="{{ route('projects') }}">المشاريع</a></li>
                <li><a href="{{ route('blog') }}">المقالات</a></li>
                <li><a href="{{ route('contact') }}">اتصل بنا</a></li>
            </ul>
        </div>
    </div>
</div>

<header class="th-header header-layout3">
    <div class="sticky-wrapper">
        <div class="sticky-active">
            <div class="header-menu">
                <div class="menu-area">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <button class="th-menu-toggle">
                                <i class="fas fa-bars-staggered"></i>الصفحة الرئيسية
                            </button>
                        </div>
                        <div class="col-auto d-flex align-items-center">
                            <div class="header-links d-none d-sm-block">
                                <ul>
                                    @if($social->phone_option)
                                    <li>
                                        <a 
                                            href="tel:{{ $social->phone }}"
                                            class="header-call text-white"
                                        ><i class="fas fa-phone ps-2 phone"></i></a
                                        >
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="th-social me-5" style="display: flex;">
                                @if($social->facebook_option)
                                    <a target="_blank" href="{{ $social->facebook }}"
                                    ><i class="fab fa-facebook-f"></i
                                        ></a>
                                 @endif

                                 @if($social->skype_option)
                                <a target="_blank" href="{{ $social->skype }}"
                                ><i class="fab fa-skype"></i
                                    ></a>
                                @endif
                                @if($social->twitter_option)
                                    <a target="_blank" href="{{ $social->twitter }}"
                                    ><i class="fab fa-twitter"></i
                                        ></a>
                               @endif

                                @if($social->whatsup_option)
                                    <li class="whatsapp">
                                        <a target="_blank"  href="https://wa.me/{{$social->whatsup}}"
                                        ><span class="fab fa-whatsapp"></span
                                            ></a>
                                    </li>
                                @endif

                                @if($social->instagram_option)
                                    <a target="_blank" href="{{ $social->instagram }}"
                                    ><i class="fab fa-instagram"></i
                                        ></a>
                                @endif
                            </div>
                            <div class="desktop-logo">
                                <a href="{{ route('home') }}"
                                ><img src="{{asset('front/img/logo.png')}}" alt="الماسة"/>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
