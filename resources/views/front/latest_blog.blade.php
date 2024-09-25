@extends('front.layout.master')
@section('content')
<div class="breadcumb-wrapper background-image"
style="background-image: url(img/slider/1.jpeg);">
<h1 class="breadcumb-title">المقالات</h1>
<ul class="breadcumb-menu">
    <li><a href="index.html">الرئيسية</a></li>
    <li>المقالات</li>
</ul>
</div>

<section class="space bg-white">
<div class="container">
    <div class="row justify-content-md-between align-items-end">
        <div class="col-md-8 wow fadeInUp" data-wow-delay="0.2s">
            <div class="title-area">
                <h2 class="sec-title">آخر <span class="text-transparent">المقالات</span> لدينا</h2>
            </div>
        </div>
        <div class="col-auto mt-n4 mt-lg-0 wow fadeInUp" data-wow-delay="0.3s">
            <div class="sec-btn"><a href="{{ route('blog') }}" class="link-btn">عرض المقالات</a></div>
        </div>
    </div>
    <div class="row th-carousel" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2"
        data-sm-slide-show="1">

        @foreach ($blogs as $blog )
        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="blog-grid">
                <div class="blog-img"><img src="{{ asset('uploads/images/cms/' . $blog->image) }}" alt="صورة المدونة"></div>
                <div class="blog-content">
                    <div class="blog-meta style2"><a href="blog-details.html">{{ $blog->translate(app()->getLocale())->name }} </a> <a
                            href="blog-details.html"> {{ $blog->created_at }} </a></div>
                    <p class="blog-text">{!! $blog->des !!}</p><a
                        href="blog-details.html" class="link-btn">اقرأ المزيد</a>
                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>
</section>
@endsection