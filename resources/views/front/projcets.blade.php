@extends('front.layout.master')

@section('content')


<div class="breadcumb-wrapper background-image"
    style="background-image: url({{ asset('uploads/images/setting/' . $settings->our_work_breadcrumb_background) }});">
    <h1 class="breadcumb-title">المشاريع</h1>
    <ul class="breadcumb-menu">
        <li><a href="index.html">الرئيسية</a></li>
        <li>المشاريع</li>
    </ul>
</div>

<div class="space gallery_area">
    <div class="container">
    
        <div class="row justify-content-lg-between align-items-end">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="title-area"><span class="big-title">م.</span>
                    <h2 class="sec-title">المشاريع <span class="text-transparent">المميزة</span></h2>
                </div>
            </div>
            
        </div>
        <div class="row project-slide2 th-carousel" data-slide-show="2">


            @foreach ($projects as $index => $project )

                <div class="col-md-4">
                    <div class="project-box">
                        <div class="project-img"><img src="{{ asset('/uploads/images/ourworks/' . $project->photo) }}" alt=" {{ $project->translate(app()->getLocale())->alt_image }}">
                        </div>
                        <div class="project-content">
                            <div class="project-number">0{{ $index + 1  }}</div>
                            <h3 class="h5 project-title"><a href="{{ asset('/uploads/images/ourworks/' . $project->photo) }}" data-fancybox="">  {{ $project->translate(app()->getLocale())->name }}</a></h3>
                            <p class="project-map"><i class="fas fa-location-dot"></i> {{ $project->link }}  </p>
                        </div>
                    </div>
                </div>
                
            @endforeach


        </div>
        <!-- <div class="text-center mt-5"><a href="project.html" class="link-btn">عرض جميع المشاريع</a></div> -->
    </div>
</div>


@endsection