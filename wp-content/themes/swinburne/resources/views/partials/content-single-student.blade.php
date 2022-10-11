<div class="about-detail news-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="main-content-detail main-news">
                    <h1>{{ get_the_title()}}</h1>
                    <div>{!! the_content() !!}</div>
                    <hr>
                    <h3>
                        <?php echo $title ?>
                    </h3>
                    <div class="university-area list-post-news">
                        <div class="list-posts-about">
                            <div class="row">
                                @php
                                @endphp
                                @if ($query_student->have_posts())
                                @while ($query_student->have_posts())
                                @php
                                $query_student->the_post();
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
                        @php
                            //lấy link downlad tài liệu từng khóa học
                            $sort_url_cource = explode('/', $_SERVER["REQUEST_URI"]);
                            $download_course_all = (pll_current_language('slug') === 'vi') ? $sort_url_cource[2] : $sort_url_cource[3];
                            $link_cource_download ='';
                            if (pll_current_language('slug') === 'vi') {
                                $category_download = get_term_by('slug', $download_course_all, 'list-download');
                                if(isset($category_download) && !empty($category_download)) {
                                    $category_id_download = $category_download->term_id;
                                    $link_cource_download = get_term_link($category_id_download);
                                }
                            } else {
                                $category_download = get_term_by('slug', $download_course_all, 'list-download');
                                if(isset($category_download) && !empty($category_download)) {
                                    $category_id_download = $category_download->term_id;
                                    $link_cource_download = get_term_link($category_id_download);
                                }
                            }
                        @endphp
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
                        
                        <li>
                            <a href="{!! $link_cource_download !!}"><i class="fa fa-download" aria-hidden="true"></i>
                            {!! pll_current_language('slug')==='vi' ? 'TẢI TÀI LIỆU' : 'DOWNLOAD A BROCHURE'!!}
                            </a>
                        </li>
                    </ul>
                    {{-- <div class="news-sidebar">
                        <div class="sideba-title">
                            <div class="single-post-about">
                                <div class="img-posts-about">
                                  <a><img src="{{ get_field('file_image', 19)}}" alt="hr"></a>
                                </div>
                                <div class="content-posts-about big-title-right">
                                    <h4>
                                        {!! pll_current_language('slug')==='vi' ? wp_trim_words(get_field('file_title_vi', 19), $num_words = 5) : wp_trim_words(get_field('file_title', 19), $num_words = 5) !!}
                                    </h4>
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
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>