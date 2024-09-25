@extends('front.layout.master')

@section('content')

<div class="breadcumb-wrapper background-image" style="background-image: url({{ asset('images/contactus/'.$contact->photo) }});">
<h1 class="breadcumb-title">اتصل بنا</h1>
<ul class="breadcumb-menu">
    <li><a href="index.html">الرئيسية</a></li>
    <li>المقالات</li>
</ul>
</div>

<section class="space contact_area">
<div class="container">
    <div class="space-bottom">
        <div class="footer-info-box wow fadeInUp" data-wow-delay="0.2s">
            <div class="row gx-0 justify-content-between">
                <div class="col-lg-4 col-sm-auto">
                    <div class="footer-box">
                       <ul>
                            <li>
                                <h6 class="footer-info has-icon"><i class="fas fa-envelope"></i> <a class="link"
                                    href="mailto:info-artraz@artrazmail.com">{{ $contact->email }}</a>
                                   </h6>
                            </li>

                       </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md order-3 order-md-0">
                    <div class="footer-box">
                        <ul>
                         @if ($contact->phone1)
                         <li>
                            <h6 class="footer-info has-icon"><i class="fas fa-phone"></i> <a class="link"
                                href="tel:{{ $contact->phone1 }}"><span dir="ltr">{{ $contact->phone1 }}</span></a> </h6>
                        </li>
                         @endif

                         @if ($contact->phone3)
                         <li>
                            <h6 class="footer-info has-icon"><i class="fas fa-phone"></i> <a class="link"
                                href="tel:{{ $contact->phone3  }}"><span dir="ltr">{{ $contact->phone3 }}</span></a> </h6>
                        </li>
                         @endif


                         @if ($contact->phone2)
                         <li>
                            <h6 class="footer-info has-icon"><i class="fas fa-phone"></i> <a class="link"
                                href="tel:{{ $contact->phone2 }}"><span dir="ltr">{{ $contact->phone2 }}</span></a> </h6>
                        </li>
                         @endif


                       </ul>

                    </div>
                </div>
                <div class="col-lg-4 col-sm-auto">
                    <div class="footer-box">
                        <ul>
                            <li>
                                <h6 class="footer-info has-icon"><i class="fas fa-location-dot"></i> <a class="link"
                                    href="https://www.google.com/maps">{{ $contact->translate(app()->getLocale())->address }}
                                    </a></h6>
                            </li>

                       </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-between">
        <div class="col-xl-6 mb-5 mb-xl-0 wow fadeInLeft" data-wow-delay="0.2s"><span
                class="h6 mt-n2 mb-3 text-theme">تواصل معنا</span>
            <h2 class="sec-title mb-45">هل تحتاج إلى أي مساعدة؟<br>أرسل <span class="text-theme">رسالة.</span>
            </h2>
            <form action="{{ route('send.contact') }}" method="POST" class="contact-form ajax-contact">
                @csrf
                <div class="row">
                    <div class="form-group col-12"><input type="text" class="form-control" name="name" id="name"
                            placeholder="اسمك" value="{{ old('name') }}">
                            @error('name')
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                            @enderror

                        </div>
                    <div class="form-group col-md-6"><input type="number" class="form-control" name="phone"
                            id="number" placeholder="رقمك" value="{{ old('phone') }}">
                            @error('phone')
                            <div class="text-danger">{{ $errors->first('phone') }}</div>
                            @enderror
                        </div>
                    <div class="form-group col-md-6"><input type="text" class="form-control" name="subject"
                            id="subject" placeholder="الموضوع" value="{{ old('subject') }}">
                            @error('subject')
                            <div class="text-danger">{{ $errors->first('subject') }}</div>
                            @enderror
                        </div>
                    <div class="form-group col-12"><input type="email" class="form-control" name="email" id="email"
                            placeholder="عنوان البريد الإلكتروني" value="{{ old('email') }}">
                            @error('email')
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                            @enderror
                        </div>
                    <div class="form-group col-12"><textarea name="message" id="message" cols="30" rows="3"
                            class="form-control" placeholder="الرسالة">{{ old('message') }}</textarea>
                            @error('message')
                            <div class="text-danger">{{ $errors->first('message') }}</div>
                            @enderror
                        </div>
                    <div class="form-btn col-12 mt-10"><button type="submit" class="th-btn"><span class="line left"></span>
                            أرسل لنا رسالة <span class="line"></span></button></div>
                </div>
                <p class="form-messages mb-0 mt-3"></p>
            </form>
        </div>
        <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
            <div class="contact-map">


                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d764276.2682042114!2d10.050691296133929!3d51.00769244133826!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x479a721ec2b1be6b%3A0x75e85d6b8e91e55b!2sGermany!5e0!3m2!1sen!2sbd!4v1695286031738!5m2!1sen!2sbd"
                    allowfullscreen="" width="100%" loading="lazy"></iframe></div>
        </div>
    </div>
</div>
</section>
@endsection







