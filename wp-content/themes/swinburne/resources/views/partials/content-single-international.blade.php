<div class="about-detail news-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="main-content-detail main-news">
                    <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                    <hr>
                    <h1>
                        {{ get_the_title()}}
                    </h1>
                    <div>{!! the_content() !!}</div>
                    <hr>
                    <div class="university-area list-post-news">
                        <div class="list-posts-about">
                            <div class="row">
                                @php
                                @endphp
                                @if ($query_international->have_posts())
                                @while ($query_international->have_posts())
                                @php
                                $query_international->the_post();
                                @endphp
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="single-post-about">
                                        <a href="{{ get_the_permalink() }}">
                                            <div class="img-posts-about single-post-about" style="background-image: url('{{ get_the_post_thumbnail_url() }}');">
                                            </div>
                                        </a>
                                        <div class="content-posts-about">
                                            <h4><a href="{{ get_the_permalink() }}">{{ get_the_title()}}</a></h4>
                                            <div class="descrip-abouts">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endwhile
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="sidebar">
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
                    </ul>
                    <div class="news-sidebar">
                        <div class="sideba-title">
                            <div class="single-post-about">
                                <div class="img-posts-about">
                                    <a><img src="{{ get_field('file_image', 19)}}" alt="hr"></a>
                                </div>
                                <div class="content-posts-about big-title-right">
                                    <h2>
                                        {!! pll_current_language('slug')==='vi' ? wp_trim_words(get_field('file_title_vi', 19), $num_words = 5) : wp_trim_words(get_field('file_title', 19), $num_words = 5) !!}
                                    </h2>
                                    <div class="descrip-abouts">
                                        <p>
                                            {!! pll_current_language('slug')==='vi' ? wp_trim_words(get_field('file_description_vi', 19), $num_words = 5) : wp_trim_words(get_field('file_description', 19), $num_words = 15) !!}
                                        </p>
                                    </div>
                                    <div class="download-link">
                                        <a href="{!! pll_current_language('slug')==='vi' ? site_url('trang-tai-file') : site_url('download-2') !!}">{!! pll_current_language('slug')==='vi' ? 'Tải tài liệu' : 'Download the issue'!!} <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>