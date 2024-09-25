!function(e) {
    "use strict";
  
    e.fn.thmobilemenu = function(t) {
        var s = e.extend({
            menuToggleBtn: ".th-menu-toggle",
            bodyToggleClass: "th-body-visible",
            subMenuClass: "th-submenu",
            subMenuParent: "th-item-has-children",
            subMenuParentToggle: "th-active",
            meanExpandClass: "th-mean-expand",
            appendElement: '<span class="th-mean-expand"><i class="fas fa-chevron-down"></i></span>',
            subMenuToggleClass: "th-open",
            toggleSpeed: 400
        }, t);
        return this.each((function() {
            var t = e(this);
            function a() {
                t.toggleClass(s.bodyToggleClass);
                var a = "." + s.subMenuClass;
                e(a).each((function() {
                    e(this).hasClass(s.subMenuToggleClass) && (e(this).removeClass(s.subMenuToggleClass),
                    e(this).css("display", "none"),
                    e(this).parent().removeClass(s.subMenuParentToggle))
                }
                ))
            }
            t.find("li").each((function() {
                var t = e(this).find("ul");
                t.addClass(s.subMenuClass),
                t.css("display", "none"),
                t.parent().addClass(s.subMenuParent),
                t.prev("a").append(s.appendElement),
                t.next("a").append(s.appendElement)
            }
            ));
            var o = "." + s.meanExpandClass;
            e(o).each((function() {
                e(this).on("click", (function(t) {
                    var a;
                    t.preventDefault(),
                    a = e(this).parent(),
                    e(a).next("ul").length > 0 ? (e(a).parent().toggleClass(s.subMenuParentToggle),
                    e(a).next("ul").slideToggle(s.toggleSpeed),
                    e(a).next("ul").toggleClass(s.subMenuToggleClass)) : e(a).prev("ul").length > 0 && (e(a).parent().toggleClass(s.subMenuParentToggle),
                    e(a).prev("ul").slideToggle(s.toggleSpeed),
                    e(a).prev("ul").toggleClass(s.subMenuToggleClass))
                }
                ))
            }
            )),
            e(s.menuToggleBtn).each((function() {
                e(this).on("click", (function() {
                    a()
                }
                ))
            }
            )),
            t.on("click", (function(e) {
                e.stopPropagation(),
                a()
            }
            )),
            t.find("div").on("click", (function(e) {
                e.stopPropagation()
            }
            ))
        }
        ))
    }
    ,
    e(".th-menu-wrapper").thmobilemenu(),
    e(window).scroll((function() {
        e(this).scrollTop() > 500 ? e(".sticky-wrapper").addClass("sticky") : e(".sticky-wrapper").removeClass("sticky")
    }
    )),
   
    e("[data-bg-src]").length > 0 && e("[data-bg-src]").each((function() {
        var t = e(this).attr("data-bg-src");
        e(this).css("background-image", "url(" + t + ")"),
        e(this).removeAttr("data-bg-src").addClass("background-image")
    }
    )),
    e("[data-mask-src]").length > 0 && e("[data-mask-src]").each((function() {
        var t = e(this).attr("data-mask-src");
        e(this).css({
            "mask-image": "url(" + t + ")",
            "-webkit-mask-image": "url(" + t + ")"
        }),
        e(this).removeAttr("data-mask-src")
    }
    )),
   
    e("[data-ani-duration]").each((function() {
        var t = e(this).data("ani-duration");
        e(this).css("animation-duration", t)
    }
    )),
    e("[data-ani-delay]").each((function() {
        var t = e(this).data("ani-delay");
        e(this).css("animation-delay", t)
    }
    )),
    e("[data-ani]").each((function() {
        var t = e(this).data("ani");
        e(this).addClass(t),
        e(".slick-current [data-ani]").addClass("th-animated")
    }
    )),
    e(".slick-slider").on("afterChange", (function(t, s, a, o) {
        e(s.$slides).find("[data-ani]").removeClass("th-animated"),
        e(s.$slides[a]).find("[data-ani]").addClass("th-animated")
    }
    )),
    e(".brands_logo").each((function() {
        var t = e(this);
        function s(e) {
            return t.data(e)
        }
        var a = '<button type="button" class="slick-prev"><i class="' + s("prev-arrow") + '"></i></button>'
          , o = '<button type="button" class="slick-next"><i class="' + s("next-arrow") + '"></i></button>';
        e("[data-slick-next]").each((function() {
            e(this).on("click", (function(t) {
                t.preventDefault(),
                e(e(this).data("slick-next")).slick("slickNext")
            }
            ))
        }
        )),
        e("[data-slick-prev]").each((function() {
            e(this).on("click", (function(t) {
                t.preventDefault(),
                e(e(this).data("slick-prev")).slick("slickPrev")
            }
            ))
        }
        )), 1 == s("arrows") && (t.closest(".arrow-wrap").length || t.closest(".container").parent().addClass("arrow-wrap")),
        t.slick({
            dots: !!s("dots"),
            fade: !!s("fade"),
            arrows: !!s("arrows"),
            speed: s("speed") ? s("speed") : 1e3,
            asNavFor: !!s("asnavfor") && s("asnavfor"),
            autoplay: 0 != s("autoplay"),
            infinite: 0 != s("infinite"),
            slidesToShow: s("slide-show") ? s("slide-show") : 1,
            adaptiveHeight: !!s("adaptive-height"),
            centerMode: !!s("center-mode"),
            autoplaySpeed: s("autoplay-speed") ? s("autoplay-speed") : 8e3,
            centerPadding: s("center-padding") ? s("center-padding") : "0",
            focusOnSelect: 0 != s("focuson-select"),
            pauseOnFocus: !!s("pauseon-focus"),
            pauseOnHover: !!s("pauseon-hover"),
            variableWidth: !!s("variable-width"),
            vertical: !!s("vertical"),
            verticalSwiping: !!s("vertical"),
            prevArrow: s("prev-arrow") ? a : '<button type="button" class="slick-prev"><i class="fal fa-long-arrow-left"></i></button>',
            nextArrow: s("next-arrow") ? o : '<button type="button" class="slick-next"><i class="fal fa-long-arrow-right"></i></button>',
            rtl: "rtl" == e("html").attr("dir"),
            responsive: [{
                breakpoint: 1600,
                settings: {
                    arrows: !!s("xl-arrows"),
                    dots: !!s("xl-dots"),
                    slidesToShow: s("xl-slide-show") ? s("xl-slide-show") : s("slide-show"),
                    centerMode: !!s("xl-center-mode"),
                    centerPadding: 0
                }
            }, {
                breakpoint: 1400,
                settings: {
                    arrows: !!s("ml-arrows"),
                    dots: !!s("ml-dots"),
                    slidesToShow: s("ml-slide-show") ? s("ml-slide-show") : s("slide-show"),
                    centerMode: !!s("ml-center-mode"),
                    centerPadding: 0
                }
            }, {
                breakpoint: 1200,
                settings: {
                    arrows: !!s("lg-arrows"),
                    dots: !!s("lg-dots"),
                    slidesToShow: s("lg-slide-show") ? s("lg-slide-show") : s("slide-show"),
                    centerMode: !!s("lg-center-mode") && s("lg-center-mode"),
                    centerPadding: 0
                }
            }, {
                breakpoint: 992,
                settings: {
                    arrows: !!s("md-arrows"),
                    dots: !!s("md-dots"),
                    slidesToShow: s("md-slide-show") ? s("md-slide-show") : 1,
                    centerMode: !!s("md-center-mode") && s("md-center-mode"),
                    centerPadding: 0
                }
            }, {
                breakpoint: 768,
                settings: {
                    arrows: !!s("sm-arrows"),
                    dots: !!s("sm-dots"),
                    slidesToShow: s("sm-slide-show") ? s("sm-slide-show") : 1,
                    centerMode: !!s("sm-center-mode") && s("sm-center-mode"),
                    centerPadding: 0
                }
            }, {
                breakpoint: 576,
                settings: {
                    arrows: !!s("xs-arrows"),
                    dots: !!s("xs-dots"),
                    slidesToShow: s("xs-slide-show") ? s("xs-slide-show") : 1,
                    centerMode: !!s("xs-center-mode") && s("xs-center-mode"),
                    centerPadding: 0
                }
            }]
        })
    }
    )),e("#heroSlide2").each((function() {
        e(this).slick({
            slidesToShow: 1,
            speed: 1e3,
            autoplaySpeed: 2000,
            arrows: !1,
            fade: !0,
            dots: !0,
            appendDots: e(this).siblings(".slider-nav-wrap").find(".custom-dots")
        })
    }
    ));
    $(function () {
        var section = document.querySelector('.counter-section');
        var hasEntered = false;
        if (! section)
            return;

        var initAnimate = (window.scrollY + window.innerHeight) >= section.offsetTop;
        if (initAnimate && !hasEntered) {
            hasEntered = true;
            counterActivate();
        }

        window.addEventListener('scroll', (e) => {
            var shouldAnimate = (window.scrollY + window.innerHeight) >= section.offsetTop;

            if (shouldAnimate && !hasEntered) {
                hasEntered = true;
                counterActivate();
            }
        });
        function counterActivate() {
            $('.counter-count .count').each(function () {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 4000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now), 3);
                    }
                });
            });
        }
    }); // END OF DOCUMENT READY
    $('[data-fancybox=""]').fancybox({
        preventCaptionOverlap : false,
        infobar: false,
      
        // Disable idle
        idleTime : 0,
      
        // Display only these two buttons
        buttons : [
          'info', 'close'
        ],
      
    
      
        onInit: function(instance) {
      
          // Toggle caption on tap
          instance.$refs.container.on('touchstart', '[data-fancybox-info]', function(e) {
            e.stopPropagation();
            e.preventDefault();
      
            instance.$refs.container.toggleClass('fancybox-vertical-caption');
          });
      
          // Display caption on button hover
          instance.$refs.container.on('mouseenter', '[data-fancybox-info]', function(e) {
            instance.$refs.container.addClass('fancybox-vertical-caption');
      
            // Hide caption when mouse leaves caption area
            instance.$refs.caption.one('mouseleave', function(e) {
              instance.$refs.container.removeClass('fancybox-vertical-caption');
            });
      
          });
      
        }
      
      });
      $(document).ready(function () {
        $('.support').on('click',function () {
            $('.social-links-fixed').toggleClass('open');
        }); 
    });
}(jQuery);
