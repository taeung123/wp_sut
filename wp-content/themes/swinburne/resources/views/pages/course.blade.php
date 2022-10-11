@extends('layouts.app')
@section('content')
    <div class="navbar-study">
        <section class="top-nav">
            <div class="container fix-height">
                <input id="menu-toggle" type="checkbox" />
                <label class='menu-button-container' for="menu-toggle">
                    <div class='menu-button'></div>
                </label>
                <div class="menu-wrapper">
                    @if (has_nav_menu('study-menu'))
                        {!! wp_nav_menu(['theme_location' => 'study-menu', 'menu_class' => 'menu-study menu menu-nav finel-nav learn-us', 'walker' => new MY_Menu_Walker()]) !!}
                    @endif
                    <script>

                    </script>
                </div>
            </div>
        </section>
    </div>
    <div class="banner-study fixheight" style="background-image: url('{!! pll_current_language('slug') === 'vi' ? get_option('study_with_us_vi') : get_option('study_with_us') !!}');">

    </div>
    <div class="about-detail course-study">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="main-content-detail main-content-course">
                        <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                        <hr>
                        <h1>{{ $object_current->post_title }}</h1>
                        <div class="detail-cont-descript">
                            {!! $object_current->post_content !!}
                        </div>
                        <div class="find-a-unit">
                            <div class="unit-title">
                                <h2> {!! pll_current_language('slug') === 'vi' ? 'TÌM KHÓA HỌC' : 'FIND A MAJOR UNIT' !!}</h2>
                            </div>
                            <div class="row">
                                @foreach ($terms as $value)
                                    @php
                                        if (function_exists('z_taxonomy_image_url')) {
                                            $img = z_taxonomy_image_url($value->term_id);
                                        } else {
                                            $img = '';
                                        }
                                    @endphp
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="single-unit-detail">
                                            <a href="{{ get_term_link($value->term_id) }}">
                                                <div class="unit-detail-img"
                                                    style="background-image: url('{{ $img }}');">

                                                </div>
                                            </a>
                                            <div class="unit-detail-txt">
                                                <h3><a
                                                        href="{{ get_term_link($value->term_id) }}">{{ $value->name }}</a>
                                                </h3>
                                                <div class="detail-dest">
                                                    <p>{{ wp_trim_words($value->description, $num_words = 20) }}</p>
                                                    <div class="go-to-link">
                                                        <a href="{{ get_term_link($value->term_id) }}">
                                                            {!! pll_current_language('slug') === 'vi' ? 'khám phá' : 'discover' !!}<i class="fa fa-arrow-right"
                                                                aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="apply-now apply_pd">
                                                <a href="{!! pll_current_language('slug') === 'vi' ? site_url('lien-he') : site_url('contact-us') !!}"><i class="fa fa-paper-plane"
                                                        aria-hidden="true"></i> {!! pll_current_language('slug') === 'vi' ? 'ĐĂNG KÝ NHẬP HỌC' : 'APPLICATION' !!}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="video-frame">
                            <div class="unit-title">
                                <h2>Video</h2>
                            </div>
                            <iframe src="{{ get_field('video_iframe', 357) }}" frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                        <hr>
                        <div class="event-study">
                            <div class="event-title">
                                <div class="event-link">
                                    <h2> {!! pll_current_language('slug') === 'vi' ? 'TIN TỨC' : 'NEWS' !!}</h2>
                                    <div class="go-to">
                                        <a href="{{ site_url('news') }}"> {!! pll_current_language('slug') === 'vi' ? 'khám phá' : 'discover' !!}<i
                                                class="fa fa-arrow-right" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    @php
                                    @endphp
                                    @if ($hight->have_posts())
                                        @while ($hight->have_posts())
                                            @php
                                                $hight->the_post();
                                            @endphp
                                            <div class="col-lg-8 col-md-8">
                                                <div class="big-picture">
                                                    <a href="{{ get_the_permalink() }}">
                                                        <div class="picture-img hg-min"
                                                            style="background-image: url('{{ get_the_post_thumbnail_url() }}');">

                                                        </div>
                                                    </a>
                                                    <div class="tex-event-course">
                                                        <h3><a href="{{ get_the_permalink() }}">{{ get_the_title() }}
                                                            </a></h3>
                                                        <p>{!! get_field('custom_descript_single_post', 677) !!}</p>
                                                        <div class="go-to-link">
                                                            <a href="{{ get_the_permalink() }}">
                                                                {!! pll_current_language('slug') === 'vi' ? 'khám phá' : 'discover' !!}<i class="fa fa-arrow-right"
                                                                    aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endwhile
                                    @endif
                                    <div class="col-lg-4 col-md-4">
                                        @php
                                        @endphp
                                        @if ($query_news->have_posts())
                                            @while ($query_news->have_posts())
                                                @php
                                                    $query_news->the_post();
                                                @endphp
                                                <div class="big-picture big-img-col4">
                                                    <div class="picture-img">
                                                        <a href="{{ get_the_permalink() }}"> <img
                                                                src="{{ get_the_post_thumbnail_url() }}" alt="hr"></a>
                                                    </div>
                                                    <div class="tex-event-course small-txt-course">
                                                        <h3><a href="{{ get_the_permalink() }}">{{ get_the_title() }}
                                                            </a></h3>
                                                        <p>{!! wp_trim_words(get_field('custom_descript_single_post'), $num_words = 40) !!}</p>
                                                    </div>
                                                </div>
                                            @endwhile
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <ul class="enquiry-apply enquiry-pd">
                        <li>
                            <a href="{!! pll_current_language('slug') === 'vi' ? get_option('apply_now_vn_title') : get_option('apply_now_en_title') !!}">
                                <i class="fa {!! get_option('apply_now_icon') !!}" aria-hidden="true"></i> {!! pll_current_language('slug') === 'vi' ? get_option('apply_now_vn') : get_option('apply_now_en') !!}
                            </a>
                        </li>
                        <li>
                            <a href="{!! pll_current_language('slug') === 'vi' ? get_option('apply_now_link_download_vn') : get_option('apply_now_link_download_en') !!}"><i class="fa {!! get_option('apply_now_icon_download') !!}"
                                    aria-hidden="true"></i>
                                {!! pll_current_language('slug') === 'vi' ? get_option('title_apply_download_vn') : get_option('title_apply_download_en') !!}
                            </a>
                        </li>
                        <li>
                            <a href="{!! pll_current_language('slug') === 'vi' ? get_option('link_online_application_vn') : get_option('link_online_application_en') !!}">
                                <i class="fa {!! get_option('icon_online_application') !!}" aria-hidden="true"></i>
                                {!! pll_current_language('slug') === 'vi' ? get_option('title_online_application_vn') : get_option('title_online_application_en') !!}
                            </a>
                        </li>
                    </ul>
                    <ul class="enquiry-apply">
                        <li class="red-bg">
                            <a class="no_hover">{!! pll_current_language('slug') === 'vi' ? get_option('title_contacs_vn') : get_option('title_contacs_en') !!}</a>
                        </li>
                        <li>
                            <a href="{{ get_option('visit_us') }}"><i class="fa {!! get_option('visit_us_icon') !!}"
                                    aria-hidden="true"></i>
                                {!! pll_current_language('slug') === 'vi' ? get_option('visit_us_label_vi') : get_option('visit_us_label') !!}</a>
                        </li>
                        <li>
                            <a href="tel:{{ get_option('Phone_call') }}">
                                <i class="fa {!! get_option('Phone_icon') !!}" aria-hidden="true"></i>
                                {!! pll_current_language('slug') === 'vi' ? 'GỌI NGAY' : 'CALL US ON ' !!} {{ get_option('Phone_call') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ get_option('email_contact') }}" target="_blank">
                                <i class="fa {!! get_option('email_contact_icon') !!}"
                                    aria-hidden="true"></i>{{ get_option('email_label') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ get_option('swinburne_href') }}">
                                <i class="fa {!! get_option('swinburne_fb_icon') !!}"
                                    aria-hidden="true"></i>{{ get_option('swinburne_name_facebook') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
