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
                    <div class="single-content">
                        {!! the_content() !!}
                    </div>
                    <div class="university-area list-post-news">
                        <div class="list-posts-about">
                            <div class="row">
                                @php
                                @endphp
                                @if ($query_business->have_posts())
                                @while ($query_business->have_posts())
                                @php
                                $query_business->the_post();
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
                <div class="sidebar sidebar-research">
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
                            <h3>News</h3>
                            @php
                            @endphp
                            @if ($query_business->have_posts())
                            @while ($query_business->have_posts())
                            @php
                            $query_business->the_post();
                            @endphp
                            <div class="single-sidebar">
                                <div class="row">
                                    <div class="col-lg-4 col-md-3">
                                        <div class="sidebar-img sb-research">
                                            <a href=""> <img src="{{get_the_post_thumbnail_url()}}" alt="hr"></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-4">
                                        <div class="sidebar-descript sidebar-research">
                                            <a href="{{ get_the_permalink()}}">{{ get_the_title()}}</a>
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
    </div>
</div>