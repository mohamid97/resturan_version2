@extends('front.layout.master')

@section('content')
<div class="breadcumb-wrapper background-image"
style="background-image: url(img/slider/1.jpeg);">
<h1 class="breadcumb-title">تفاصيل المقالة</h1>
<ul class="breadcumb-menu">
    <li><a href="index.html">الرئيسية</a></li>
    <li>تفاصيل المقالة</li>
</ul>
</div>

<section class="space-top space-extra-bottom bg-white">
<div class="container">
  <div class="row">
      <div class="col-lg-8">
          <div class="page-single">
              <div class="page-img"><img class="w-100" src="./img/slider/1.jpeg"
                      alt="Service Image"></div>
                      <h3 class="single-title">تصميم الديكور الداخلي</h3>
              <div class="service-content">
                <p class="mb-30">تعزز بشكل متواصل الاحتفاظ بمساحة العقل الشاملة مع خدمات الويب المستندة إلى
                    العميل. تمكين المحفزات للتغيير قبل اختبار الأسواق بشكل كامل. الاحتفاظ بسيناريوهات لاسلكية بشكل
                    فوسفوري بعد تطبيقات متطلبات الأداء. التفوق بشكل ملائم في توجيهات الجودة الثورية من خلال المنتجات
                    المستدامة. التحول بحماس في التعاون المميز.</p>
                <p class="mb-30">تنسيق وظائف متعددة الوظائف والإمكانيات الموثوقة. التصور الهادف بشكل موضوعي
                    عالٍ من خلال الشبكات التعاونية. توليد التجار الإلكتروني B2C لاستعادة بيانات الأعمال من خلال
                    العلاقات المبحوثة تمامًا.</p>
                  <div class="row gy-30 mb-40">
                      <div class="col-md-6"><img class="w-100" src="./img/pj/1.png"
                              alt="image"></div>
                      <div class="col-md-6">
                        <h4 class="mb-20">تخطيط البيئة</h4>
                        <h5>نهج التصميم</h5>
                        <p>الترويج بحماس للتآزر الفردي وتحقيق الحد الأقصى للمنتجات.</p>
                        <h5>حلول مبتكرة</h5>
                        <p>الترويج بحماس للتآزر الفردي وتحقيق الحد الأقصى للمنتجات.</p>
                        <h5>إدارة المشروع</h5>
                        <p>الترويج بحماس للتآزر الفردي وتحقيق الحد الأقصى للمنتجات.</p>
                      </div>
                  </div>
                  <h3 class="single-title">تصميم الديكور الداخلي</h3>
                  <p class="mb-30">تعزز بشكل متواصل الاحتفاظ بمساحة العقل الشاملة مع خدمات الويب المستندة إلى
                    العميل. تمكين المحفزات للتغيير قبل اختبار الأسواق بشكل كامل. الاحتفاظ بسيناريوهات لاسلكية بشكل
                    فوسفوري بعد تطبيقات متطلبات الأداء. التفوق بشكل ملائم في توجيهات الجودة الثورية من خلال المنتجات
                    المستدامة. التحول بحماس في التعاون المميز.</p>
                <p class="mb-30">تنسيق وظائف متعددة الوظائف والإمكانيات الموثوقة. التصور الهادف بشكل موضوعي
                    عالٍ من خلال الشبكات التعاونية. توليد التجار الإلكتروني B2C لاستعادة بيانات الأعمال من خلال
                    العلاقات المبحوثة تمامًا.</p>
                  <div class="row gy-30">
                      <div class="col-md-6"><img class="w-100" src="./img/pj/1.png"
                              alt="image"></div>
                      <div class="col-md-6"><img class="w-100" src="./img/pj/1.png"
                              alt="image"></div>
                  </div>
                  <p class="mt-30 mb-n2">تنسيق وظائف متعددة الوظائف والإمكانيات الموثوقة. التصور الهادف بشكل موضوعي
                    عالٍ من خلال الشبكات التعاونية. توليد التجار الإلكتروني B2C لاستعادة بيانات الأعمال من خلال
                    العلاقات المبحوثة تمامًا.</p>
              </div>
          </div>
      </div>
      <div class="col-lg-4">
        <aside class="sidebar-area">
            {{-- <div class="widget widget_search">
                <form class="search-form"><input type="text" placeholder="البحث..."> <button type="submit"><i
                            class="fas fa-search"></i></button></form>
            </div> --}}
            {{-- <div class="widget widget_categories">
                <h3 class="widget_title">التصنيفات</h3>
                <ul>
                    <li><a href="blog.html">تصميم الديكور الداخلي</a></li>
                    <li><a href="blog.html">الهندسة المعمارية</a></li>
                    <li><a href="blog.html">المناظر الطبيعية</a></li>
                    <li><a href="blog.html">تدخلات حضرية</a></li>
                    <li><a href="blog.html">كيانات متعددة التخصصات</a></li>
                    <li><a href="blog.html">أرتراز إيفريثينغ</a></li>
                </ul>
            </div> --}}
            <div class="widget widget_download">
                <h4 class="widget_title">تحميل</h4>
                <div class="donwload-media-wrap">
                    <div class="download-media">
                        <div class="download-media_icon"><i class="fas fa-file-pdf"></i></div>
                        <div class="download-media_info">
                            <h5 class="download-media_title">كتيباتنا</h5><span
                                class="download-media_text">تحميل</span>
                        </div>
                        @if (isset($files[0]))
                        <a href="{{ asset('/uploads/images/media/files/'. $files[0]->file) }}" class="download-media_btn"><i
                            class="fas fa-arrow-right"></i></a>      
                        @endif


                    </div>
                    <div class="download-media">
                        <div class="download-media_icon"><i class="fas fa-file-lines"></i></div>
                        <div class="download-media_info">
                            <h5 class="download-media_title">تفاصيل الشركة</h5><span
                                class="download-media_text">تحميل</span>
                        </div>
                        @if (isset($files[1]))
                        <a href="{{ asset('/uploads/images/media/files/'.$files[1]->file) }}" class="download-media_btn" target="_blank"><i
                                class="fas fa-arrow-right"></i></a>
                                @endif
                    </div>
                </div>
            </div>
            <div class="widget">
                <div class="widget-banner">
                    <h4 class="title background-image"
                        style="background-image: url(&quot;img/slider/1.jpeg&quot;);">أفضل
                        الهندسة<br><span class="text-transparent">خدمات</span></h4>
                    <div class="content"><a href="tel:{{ $social->phone }}" class="link"><i class="fas fa-phone"></i><span dir="ltr">{{ $social->phone }}</span></a>
                        <p class="text">الإثنين - الجمعة: 7:00 صباحًا - 8:00 مساءً خدمة الطوارئ على مدار الساعة طوال أيام الأسبوع</p><a href="{{ route('about') }}" class="link-btn">من نحن</a>
                    </div>
                </div>
            </div>
        </aside>
    </div>
    
  </div>
</div>
</section>
@endsection