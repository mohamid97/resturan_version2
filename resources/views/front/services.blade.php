@extends('front.layout.master')

@section('content')

<div class="breadcumb-wrapper background-image"
style="background-image: url({{ asset('/uploads/images/setting/' . $settings->services_breadcrumb_background) }});">
<h1 class="breadcumb-title">الخدمات</h1>
<ul class="breadcumb-menu">
    <li><a href="index.html">الرئيسية</a></li>
    <li>الخدمات</li>
</ul>
</div>





        <section class="space services_area bg-white">
            <div class="container">
                <div class="row justify-content-lg-between align-items-end">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="title-area"><span class="big-title">خ.</span>
                    <!--<h2 class="sec-title">خدمات <br>هندسية عالية الجودة <span-->
                    <!--        class="text-transparent">المعمارية</span></h2>-->

                     <h2 class="sec-title">خدماتنا</h2>

                    </div>

                    <div class="my-4">

                        <ul class="nav nav-pills nav-fill gap-4" id="category-nav">

                            @foreach ($category as $cat )
                
                                <li class="nav-item">
                                   <span style="cursor: pointer" class="nav-link active-tab tabs-click" data-category="{{ $cat->id }}" aria-current="page" href="#">{{ $cat->translate(app()->getLocale())->name }}</a>
                                </li>        
                            @endforeach

                        </ul>     
                    </div>
                </div>

                </div>
                <div class="row" id="services-container">

                    @foreach ($category[0]->services as  $index => $service)
                        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="service-card">
                                <div class="service-card_icon"><img class="svg-img" src="{{  asset('uploads/images/service/' . $service->image) }}"
                                        alt="{{ $service->alt_image }}"></div>
                                <p class="service-card_num">0{{ $index + 1 }}</p>
                                <h3 class="service-card_title">
                                    <a href="{{ route('service_details' , ['slug' => $service->translate(app()->getLocale())->name]) }}">{{ $service->translate(app()->getLocale())->name }}</a></h3>
                                <p class="service-card_text text-truncate">
                                    {!! $service->translate(app()->getLocale())->des !!}

                                     
                                </p>
                            </div>
                        </div>       
                    @endforeach

                           
                </div>
            </div>
        </section>



               


@endsection


@section('scripts')
<script>
    // Add click event listener to each category nav link
    document.querySelectorAll('#category-nav .tabs-click').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();

            // Remove active class from all links
            document.querySelectorAll('#category-nav .nav-link').forEach(link => {
                link.classList.remove('active-tab');
            });

            // Add active class to the clicked link
            this.classList.add('active-tab');

            // Fetch services for the clicked category via AJAX
            const categoryId = this.getAttribute('data-category');
            fetchServices(categoryId);
        });
    });

    // Function to fetch services for a category
    function fetchServices(categoryId) {
        // Make an AJAX request to fetch services based on the category ID
        fetch(`/get-services?category=${categoryId}`)
            .then(response => response.json())
            .then(data => {
                // Update the DOM with the received services
                displayServices(data);
            })
            .catch(error => {
                console.error('Error fetching services:', error);
            });
    }

    // Function to display services in the DOM
    function displayServices(services) {
        const servicesContainer = document.getElementById('services-container');
        servicesContainer.innerHTML = ''; // Clear previous services

        // Loop through the services and create HTML elements to display them
        services.forEach((service, index) => {
            console.log(service);
            const serviceHtml = `
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-card">
                        <div class="service-card_icon"><img class="svg-img" src="{{ asset('uploads/images/service/${service.image}') }}" alt="${service.image_title}"></div>
                        <p class="service-card_num">0${index + 1}</p>
                        <h3 class="service-card_title"><a href="/service/${service.slug}">${service.name}</a></h3>
                        <p class="service-card_text text-truncate">${service.des}</p>
                    </div>
                </div>
            `;
            servicesContainer.insertAdjacentHTML('beforeend', serviceHtml);
        });
    }
</script>
@endsection