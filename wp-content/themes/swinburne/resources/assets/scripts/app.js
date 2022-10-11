import 'bootstrap';
import 'jquery';

import 'slick-carousel';
import './jquery.meanmenu.js';
import './calendar.js';

// const WOW = require('wowjs');

// new WOW.WOW().init();

// Ẩn một phần tử dựa vào slug
document.addEventListener("DOMContentLoaded", function(event) {
    if (window.location.href.indexOf("/option/online-course") != -1) {
        $(".list-posts-about").hide();
    }

    if (window.location.href.indexOf("/en/business/industry-certificates/") != -1) {
        $(".list-post-news").hide();
    }
    if (window.location.href.indexOf("/business/chung-chi-nganh/") != -1) {
        $(".list-post-news").hide();
    }
    if (window.location.href.indexOf("option/khoa-hoc-online/") != -1) {
        $(".list-post-news").hide();
    }
});

var contact_path = window.location.pathname;
var url_origin = window.location.origin + window.location.pathname;
var contact_link, replace_str;
if (contact_path == '/en/contact-us/' || contact_path == '/lien-he/') {

    contact_link = window.location.href;
    replace_str = contact_link.replace(url_origin + '?utm_source=', '');

    $('input.utm_link').attr('value', replace_str);
}


var scroll_top, window_width;
$(document).ready(function() {

    $('.wrapper_scroll1 .div1').width($('table').width());
    $('.wrapper_scroll2 .div2').width($('table').width());
    /** current window width */
    window_width = $(window).width();

    if (window_width >= 1200) {
        $('ul.menu-second > li.menu-item-has-children > a').append(
            '<span class="cs-menu-toggle"><i class="fa fa-angle-down"></i></span>'
        );
        $('ul.menu-second ul.sub-menu li.menu-item-has-children > a').append(
            '<span class="cs-menu-toggle"><i class="fa fa-angle-right"></i></span>'
        );
    }
    $('.register-form input.btn-register').click(function() {
        if ($('.form-group.registration input').is(':checked')) {
            $('.form-group.registration input').removeAttr('required');
        } else {
            if (window.location.href.indexOf("/phieu-dang-ky") != -1) {
                alert('Vui lòng chọn ít nhất 1 ngành đăng ký');
            } else {
                alert('Please select at least 1 Specialized registration');
            }
        }
    });

    $('.vc-accordion .accordion-menu span.heading').on('click', function (e) {
    e.preventDefault();
    if($(this).hasClass('open')) {
        $(this).removeClass('open');
    }
    else {
        $(this).addClass('open');
    }   
    if ($(this).next().hasClass('show')) {
        $(this).next().removeClass('show').hide().animate({ opacity: "0" }, 200);
        $(this).children('i.fa').removeClass('fa-minus').addClass('fa-plus');
    }
    else {
        $(this).next().addClass('show').show().animate({ opacity: "1" }, 200);
        $(this).children('i.fa').removeClass('fa-plus').addClass('fa-minus');
    }
    });
    $('.post-slider-items').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        arrows: true,

      });
    setTimeout(function() {
        scroll_top = $(window).scrollTop();
        var height_sum = $('.destop-header').height() + $('.vc-image').height() + $('.fancybox').height();

        if (scroll_top > height_sum) {
            $('.fancybox.has-onepage .fancybox-quick').show();

        } else {
            $('.fancybox.has-onepage .fancybox-quick').hide();
        }
    }, 400);

    const files_data = document.querySelectorAll('form .form-card');
    Array.from(files_data).forEach(function(file_data) {
        var upfile_id = $(file_data).attr('id');
        var input_id = $('#' + upfile_id + ' input[type="file"]').attr('id');
        $('#' + input_id).on('change', function() {
            var output_id = $('#' + upfile_id + ' .card-body img').attr('id');
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(`#${output_id}`).attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
            var formData = new FormData();
            var files = $(this)[0].files;
            var source_url = '';
            Array.from(files).forEach(function(file) {
                formData.append('file', file);
                var username = 'auth_registerform';
                var password = 'VxWC!ZsF%62XivXRt!!qkZX0';
                $.ajax({
                    method: "POST",
                    datatype: "json",
                    url: rest_media.endpoint,
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "Authorization": "Basic " + btoa(username + ":" + password)
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-WP-Nonce', rest_media.nonce);
                        xhr.setRequestHeader('Authorization', 'Basic ' + btoa(username + ":" + password));
                    },
                    success: (response) => {
                        source_url += response['source_url'] + '; ';
                        switch (input_id) {
                            case 'input_avatar':
                                $('.group-text-avatar_link input').attr('value', response['source_url']);
                                break;
                            case 'input_font_cmt':
                                $('.text-font_cmt_link input').attr('value', response['source_url']);
                                break;
                            case 'input_back_cmt':
                                $('.text-back_cmt_link input').attr('value', response['source_url']);
                                break;
                            case 'input_birth_certificate':
                                $('.text-birth_certificate_link input').attr('value', source_url);
                                break;
                            case 'input_learning_results':
                                $('.text-learning_results_link input').attr('value', source_url);
                                break;
                            case 'input_school_diploma':
                                $('.text-school_diploma_link input').attr('value', source_url);
                                break;
                            case 'input_english_certificate_file':
                                $('.text-english_certificate_link input').attr('value', source_url);
                                break;
                            case 'input_learning_achievements':
                                $('.text-learning_achievements_link input').attr('value', source_url);
                                break;
                        }


                    },
                    error: (response) => {
                        console.log("Sorry");
                    }
                });
            });
        });
    });

    $('label').each(function() {
        var $this = $(this);
        if ($this.html().replace(/\s|&nbsp;/g, '').length == 0)
            $this.remove();
    });

    if ($('.learn-us li a').hasClass('active')) {
        $('#menu-item-2364 a, #menu-item-983 a').addClass('distinction');
    }

    if ($('.only-research li a').hasClass('active')) {
        $('#menu-item-111 a, #menu-item-982 a').addClass('distinction');
    }
    if ($('.only-business li a').hasClass('active')) {
        $('#menu-item-108 a, #menu-item-981 a').addClass('distinction');
    }
    if ($('.only-admiss li a').hasClass('active')) {
        $('#menu-item-573 a, #menu-item-980 a').addClass('distinction');
    }
    if ($('.only-news li a').hasClass('active')) {
        $('#menu-item-3012 a, #menu-item-3013 a').addClass('distinction');
    }


});

$('.wrapper_scroll1').on('scroll', function(e) {
    $('.wrapper_scroll2').scrollLeft($('.wrapper_scroll1').scrollLeft());
});
$('.wrapper_scroll2').on('scroll', function(e) {
    $('.wrapper_scroll1').scrollLeft($('.wrapper_scroll2').scrollLeft());
});
$(document).on('scroll', function() {
    scroll_top = $(window).scrollTop();
    var height_sum = $('.destop-header').height() + $('.vc-image').height() + $('.fancybox').height();

    if (scroll_top > height_sum) {
        $('.fancybox.has-onepage .fancybox-quick').show();
    } else {
        $('.fancybox.has-onepage .fancybox-quick').hide();
    }
});

// Add class distinction dựa theo url
$(function($) {
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $('.menu-second li a').each(function() {
        if (this.href === path) {
            $(this).addClass('distinction');
        }
    });

    $('.menu-primary li a').each(function() {
        if (this.href === path) {
            $(this).addClass('activer-now');
        }
    });
});

$(document).ready(function() {
    if (window.location.href.indexOf('khoi-su-dai-hoc')) {
        //Hide the element.
        $('.student-work h3').css("display", "none");
    }
});



$(document).ready(function() {
    $('.post').on('click', function() {
        $(this).find('.summary').slideToggle();
    })
});

$('option').css('width', '20px');
//
$(document).ready(function() {
    $('.your-class').slick({
        dots: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        // autoplay: true,
        autoplaySpeed: 4000,
        arrows: true,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ],
        nextArrow: '<i id="icon_right" class="fa fa-angle-right" aria-hidden="true"></i>',
        prevArrow: '<i id="icon_left" class="fa fa-angle-left" aria-hidden="true"></i>'
    });
    $('.banner-main').slick({
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        // autoplay: true,
        autoplaySpeed: 4000,
        arrows: true,
        nextArrow: '<i id="banner_icon_right" class="fa fa-angle-right" aria-hidden="true"></i>',
        prevArrow: '<i id="banner_icon_left" class="fa fa-angle-left" aria-hidden="true"></i>',
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: true,
            }
        }]
    });
});
///
$(document).ready(function() {
    $('.slider-disco-home').slick({
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        // autoplay: true,
        autoplaySpeed: 4000,
        arrows: false,
        nextArrow: '<i id="icon_right" class="fa fa-angle-right" aria-hidden="true"></i>',
        prevArrow: '<i id="icon_left" class="fa fa-angle-left" aria-hidden="true"></i>'
    });
});

$(document).ready(function() {
    $(".slider-student").not('.slick-initialized').slick({
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        // autoplay: true,
        autoplaySpeed: 4000,
        arrows: true,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ],
        nextArrow: '<i id="icon_right" class="fa fa-angle-right" aria-hidden="true"></i>',
        prevArrow: '<i id="icon_left" class="fa fa-angle-left" aria-hidden="true"></i>'
    });
});

$(document).ready(function() {
    $(".slider-new").not('.slick-initialized').slick({
        //dots: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 4000,
        arrows: true,
        dots: true,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ],
        nextArrow: '<i id="icon_right" class="fa fa-angle-right" aria-hidden="true"></i>',
        prevArrow: '<i id="icon_left" class="fa fa-angle-left" aria-hidden="true"></i>'
    });
});

$(document).ready(function() {
    $('.slider-disco-home').slick({
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        // autoplay: true,
        autoplaySpeed: 4000,
        arrows: false,
    });
});

$(document).ready(function() {
    $('.single-slider-post').slick({
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        // autoplay: true,
        autoplaySpeed: 4000,
        arrows: false,
    });
});

$(document).ready(function() {
    $('.start-discover').click(function() {
        $('.display-none').toggle('1000');
    });
});
$(document).ready(function() {
    $('.call-last').click(function() {
        $('.para-show').toggle('1000');
    });

});
$(document).ready(function() {
    $('.sub-menu-button').click(function() {
        $(this).next().toggleClass('avtive-sub-menu')
    });

});

$(document).ready(function() {
    $('.menu-button-container').click(function() {
        $('.finel-nav').toggleClass('avtive-menu')
    });

});

$(document).ready(function() {
    var html = "<span class='cs-menu-toggle cs-toggle-right'><i class='fa fa-angle-down'></i></span>";
    $(".menu-study-menu-tieng-viet-container .menu-item-has-children>a ").append(html);
    $(".menu-study-menu-tieng-viet-container .menu-item-has-children>a ").hover(function() {
        var text = $(this).text();
        $(this).next().next().find('h2').text(text);
    });
});

$('.toppic-page .list-categories li a').each(function() {
    console.log(window.location.pathname);
    if ($(this).attr('href') + '/' == window.location.pathname) {
        $(this).addClass('active-term');
    }
});