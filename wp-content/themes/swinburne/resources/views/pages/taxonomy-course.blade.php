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
                    {!! wp_nav_menu(['theme_location' => 'study-menu', 'menu_class' => 'menu-study menu menu-nav finel-nav learn-us']) !!}
                @endif
            </div>
        </div>
    </section>
</div>
<div class="banner-study fixheight" style="background-image: url('{{$value_banner}}');">

</div>
<div class="about-detail course-study course-major">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="main-content-detail main-content-course main-content-major">
                    <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                    <hr>
                    <h1>{{ $name_by_term->name }}</h1>
                    <div class="detail-cont-descript">
                        {!! apply_filters('the_content', $name_by_term->description) !!}
                    </div>
                    <div class="majors-tab">
                        @php
                        @endphp
                        @if ($query->have_posts())
                        <h2> {!! pll_current_language('slug')==='vi' ? 'Thông tin về các chuyên ngành:' : 'Information on majors:'!!}</h2>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs one-by-one" role="tablist">
                            <li class="item-major">
                                @while ($query-> have_posts())
                                @php
                                $query->the_post();
                                @endphp
                                <a href="{{ get_the_permalink() }}">{{get_the_title()}}</a>
                                @endwhile
                                {!! wp_reset_postdata() !!}
                            </li>
                        </ul>
                        @endif
                        <!-- Tab panes -->
                    </div>
                    <div class="student-work">
                        <h3>{!! pll_current_language('slug')==='vi' ? 'Ý tưởng sinh viên' : 'Student Work '!!}</h3>
                        <div class="slider-student">
                            <div> <img src="{{ get_field('image_slider1', 'list-course'.'_'.$name_by_term->term_id) }}" alt="hr"></div>
                            <div> <img src="{{ get_field('image_slider2', 'list-course'.'_'.$name_by_term->term_id) }}" alt="hr"></div>
                            <div> <img src="{{ get_field('image_slider3', 'list-course'.'_'.$name_by_term->term_id) }}" alt="hr"></div>
                        </div>
                    </div>
                    <div class="major-content">
                        {!! get_field('majors_content', 'list-course'.'_'.$name_by_term->term_id) !!}
                    </div>
                    <div class="info-comunication">
                        <div class="img-author">
                            <div class="row">
                                <div class="man-tech col-12 col-md-6">
                                    <img alt="ảnh" src="{{ get_stylesheet_directory_uri() }}/resources/assets/images/home/no-bg.png" style="background-image: url({{ get_field('image_author', 'list-course'.'_'.$name_by_term->term_id) }}">
                                </div>
                                <div class="col-12 col-md-6 info-author">
                                    <p>{{wp_trim_words(get_field('comment', 'list-course'.'_'.$name_by_term->term_id), $num_words = 80)}}</p>
                                    <div class="signature">
                                        <span class="hr-cl"></span>
                                        <h4>{{wp_trim_words(get_field('author', 'list-course'.'_'.$name_by_term->term_id), $num_words = 10)}}</h4>
                                        <span>{{wp_trim_words(get_field('position', 'list-course'.'_'.$name_by_term->term_id), $num_words = 10)}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($query_tag->post_count > 0)
                        <div class="show-post-news">
                            <div class="university-area list-post-news">
                                <h2 class="post-title">{!! pll_current_language('slug')==='vi' ? 'Tin tức' : 'News'!!}</h2>
                                <div class="slider-new">
                                    @php
                                    @endphp
                                    @foreach($query_tag->posts as $value)
                                    @php

                                    $loop_id = $value->ID;
                                    $thumbnail_url_looppp = get_the_post_thumbnail_url($loop_id);
                                    @endphp
                                        <div class="slider-padding">
                                            <div class="single-post-about">
                                                <a href="{!! get_post_permalink($value->ID) !!}">
                                                    <div class="img-posts-about list-post-news" style="background-image: url('{{ $thumbnail_url_looppp }}');">

                                                    </div>
                                                </a>
                                                <div class="content-posts-about">
                                                    <h4><a href="{!! get_post_permalink($value->ID) !!}">{{ $value->post_title}}</a></h4>
                                                    <div class="descrip-abouts">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {!! wp_reset_postdata() !!}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-3">
                <ul class="enquiry-apply enquiry-pd">
                    <li>
                        <a href="{!! pll_current_language('slug')==='vi' ? get_option('apply_now_vn_title') : get_option('apply_now_en_title') !!}">
                            <i class="fa {!! get_option('apply_now_icon') !!}" aria-hidden="true"></i> {!! pll_current_language('slug')==='vi' ? get_option('apply_now_vn') :  get_option('apply_now_en') !!}
                        </a>
                    </li>
                    <li>
                        <a href="{!! pll_current_language('slug')==='vi' ? get_option('apply_now_link_download_vn') : get_option('apply_now_link_download_en') !!}"><i class="fa {!! get_option('apply_now_icon_download') !!}" aria-hidden="true"></i>
                        {!! pll_current_language('slug')==='vi' ? get_option('title_apply_download_vn') : get_option('title_apply_download_en')!!}
                        </a>
                    </li>
                    <li>
                        <a href="{!! pll_current_language('slug')==='vi' ? get_option('link_online_application_vn') : get_option('link_online_application_en') !!}">
                            <i class="fa {!! get_option('icon_online_application') !!}" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('title_online_application_vn') : get_option('link_online_application_vn')!!}
                        </a>
                    </li>
                </ul>
                <ul class="enquiry-apply">
                    <li class="red-bg">
                        <a class="no_hover">{!! pll_current_language('slug')==='vi' ? get_option('title_contacs_vn')  :  get_option('title_contacs_en') !!}</a>
                    </li>
                    <li>
                        <a href="{{ get_option('visit_us')}}"><i class="fa {!! get_option('visit_us_icon') !!}" aria-hidden="true"></i>
                        {!! pll_current_language('slug')==='vi' ? get_option('visit_us_label_vi') : get_option('visit_us_label') !!}</a>
                    </li>
                    <li>
                        <a href="tel:{{ get_option('Phone_call') }}">
                            <i class="fa {!! get_option('Phone_icon') !!}" aria-hidden="true"></i>
                            {!! pll_current_language('slug')==='vi' ? 'GỌI NGAY' : 'CALL US ON '!!} {{ get_option('Phone_call')}}
                        </a>
                    </li>
                    <li>
                        <a href="{{ get_option('email_contact')}}" target="_blank">
                            <i class="fa {!! get_option('email_contact_icon') !!}" aria-hidden="true"></i>{{ get_option('email_label')}}
                        </a>
                    </li>
                    <li>
                        <a href="{{ get_option('swinburne_href')}}">
                            <i class="fa {!! get_option('swinburne_fb_icon') !!}" aria-hidden="true"></i>{{ get_option('swinburne_name_facebook')}}
                        </a>
                    </li>
                    {{-- @if (get_field('link_to_buttom_download_sidebar'))
                        <li>
                            <a href="{!! get_field('link_to_buttom_download_sidebar') !!}"><i class="fa fa-download" aria-hidden="true"></i>
                                {!! pll_current_language('slug')==='vi' ? 'TẢI TÀI LIỆU' : 'DOWNLOAD A BROCHURE'!!}
                            </a>
                        </li>
                    @elseif(get_field('link_to_buttom_download_sidebar') == null || get_field('link_to_buttom_download_sidebar') == '') --}}
                        <li>
                            <a href="{!! $link_cource_download !!}"><i class="fa fa-download" aria-hidden="true"></i>
                                {!! pll_current_language('slug')==='vi' ? 'TẢI TÀI LIỆU' : 'DOWNLOAD A BROCHURE'!!}
                            </a>
                        </li>
                    {{-- @endif --}}

                </ul>
            </div>
        </div>
    </div>
</div>
@endsection