<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/png"
        href="{{ get_stylesheet_directory_uri() }}/resources/assets/images/header/FPT.png" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap&subset=vietnamese" rel="stylesheet">
    {!! wp_head() !!}

    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '485456878842590');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=485456878842590&ev=PageView&noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->

    <script type='text/javascript' src='https://code.jquery.com/jquery-1.11.0.js'></script>
    <script type='text/javascript'
        src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script type='text/javascript'>
        //<![CDATA[
        $(window).load(function() {

            $("#cssmenu").find(".button").on('click', function() {
                $(this).toggleClass('menu-opened');
                var mainmenu = $(this).next('ul');
                if (mainmenu.hasClass('open')) {
                    mainmenu.slideToggle().removeClass('open');
                } else {
                    mainmenu.slideToggle().addClass('open');
                }
            });
            $("#cssmenu").find('.sub-menu').parent().addClass('has-sub');
            $("#cssmenu").find(".has-sub").prepend(
                '<span class="submenu-button"></span>');
            $("#cssmenu").find('.submenu-button').on('click', function() {
                $(this).toggleClass('submenu-opened');
                if ($(this).siblings('ul').hasClass('open')) {
                    $(this).siblings('ul').removeClass('open').slideToggle();
                } else {
                    $(this).siblings('ul').addClass('open').slideToggle();
                }
            });
            $(
                    ".register-form .group-date-day .form-control, .register-form .group-date-test_day .form-control, .register-form .group-date-date_provider .form-control, .register-form .group-date-signature_date .form-control "
                )
                .inputmask();
            $(".register-form .group-number-year_graduates .form-control").inputmask('9999');
            const boxs = document.querySelectorAll('.single-dropdown');
            Array.from(boxs).forEach(function(box) {
                var id = $(box).children('p').attr('id');
                $('#' + id).on('click', function() {
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active');
                        $(this).next().removeClass('show').slideUp('1000');
                    } else {
                        $(this).addClass('active');
                        $(this).next().addClass('show').slideDown('1000');
                    }
                });
            });
        
        });

        //]]>
    </script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5d2407157a48df6da2439a0a/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

    <!--Quản lý comment facebook-->
    <meta property="fb:app_id" content="<?php echo get_option('id_app_fb'); ?>" />
    <meta property="fb:admins" content="AoYXg-ocqNxhd-kCVhXIe4r" />
    <!--két thúc Quản lý comment facebook-->

</head>


<!-- Comment facebook -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v5.0&appId=<?php echo get_option('id_app_fb'); ?>&autoLogAppEvents=1">
</script>
<!-- End comment facebook -->




<!-- Facebook Pixel Code -->
{{-- <script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '960609720966517');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=960609720966517&ev=PageView&noscript=1"
/></noscript> --}}
<!-- End Facebook Pixel Code -->
