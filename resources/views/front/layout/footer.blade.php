

<footer class="footer-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="footer_box">
                    <div class="footer_logo">
                        <img src="{{asset('front/img/logo.png')}}" class="img-fluid" alt="الماسه" />
                    </div>
                    <div class="content">
                        <h2> {{ $settings->website_name }}</h2>
                        <p>تشطيبات معماريه وتصميم داخلي وديكور.</p>
                        <p>
                            <strong>
                                <a href="#"> إرسل طلبك الاَن </a>
                            </strong>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="footer_box">
                    <div class="footer_title">
                        <h2>تواصل معنا</h2>
                    </div>
                    <div class="content">
                        <ul>
                            <li><i class="fas fa-house"></i> شركة  {{ $settings->website_name }} </li>
                            <li><i class="fas fa-map"></i> {{ $contact->translate(app()->getLocale())->address }}</li>
                            <li><i class="fas fa-clock"></i> خدمة 24/7</li>
                            
                            @if($social->phone_option)
                                <li>
                                    <a href="tel:{{$social->phone }}">
                                        <i class="fas fa-phone"></i>  
                                        <span dir="ltr">{{ $social->phone }}</span>
                                    </a>   
                                </li>
                            @endif

                            
                        </ul>
                    </div>
                    <div class="row">
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
                                    <li class="pinterest">
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


                                @if($social->phone_option)
                                <li class="facebook">
                                    <a href="tel:{{$social->phone}}"
                                    ><span class="fas fa-phone"></span
                                        ></a>
                                </li>
                                @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="footer_box">
                    <div class="content">
                        <ul class="products_list">
                            <li>
                                <a href="{{ route('services') }}"> الخدمات </a>
                            </li>
                            <li>
                                <a href="{{ route('about') }}"> من نحن </a>
                            </li>
                            <li>
                                <a href="{{ route('projects') }}"> مشاريعنا </a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}"> اتصل بنا   </a>
                            </li>
                            <li>
                                <a href="{{ route('blog') }}"> المقالات</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-lg-6">
                    <p class="copyright-text">
                        حقوق الطبع والنشر &copy; <a href="index.html"> {{ $settings->website_name }} </a> -
                        <span id="currentYear"></span>
                    </p>
                </div>
                <div class="col-lg-6">
                    <p class="copyright-text">
                        <strong> ماس®</strong> للتشطيبات المعمارية والتصميم
                        الداخلي والديكور
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
    integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
    integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
    crossorigin="anonymous"
></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
    integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="{{asset('front/assets/js/script.js')}}"></script>

<script>
    var currentYear = new Date().getFullYear();
    document.getElementById('currentYear').textContent = currentYear;
</script>


@yield('scripts')




</body>
</html>
