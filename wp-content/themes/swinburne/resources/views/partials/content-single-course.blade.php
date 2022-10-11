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

<div class="about-detail news-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="bg_outsite">
                    <div class="main-content-detail main-news">
                        <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                    <hr>
                    <h1>
                        {{ get_the_title()}}
                    </h1>
                        <div>{!! the_content() !!}</div>
                    </div>
                    <div class="course-detail-single">
                        <h4> {!! pll_current_language('slug')==='vi' ? 'Chi tiết khóa học:' : 'Course detail:'!!} </h4>
                        <div class="box-content">
                            <div class="single-row-content othor-color">
                                <p> {!! pll_current_language('slug')==='vi' ? 'Mã ngành học:' : 'Program Code:'!!} {!! get_field('program_code') !!}</p>
                                <p>{!! pll_current_language('slug')==='vi' ? 'Thời lượng:' : 'Duration:'!!} {!! get_field('duration_course') !!}</p>
                            </div>
                            <div class="single-row-content">
                                <p> {!! pll_current_language('slug')==='vi' ? 'Khoa:' : 'Faculty:'!!} {{ get_field('faculty_detail')}}</p>
                                <p> {!! pll_current_language('slug')==='vi' ? 'Vị trí:' : 'Location:'!!} {{ get_field('location_detail')}}</p>
                            </div>
                            <div class="single-row-content">
                                <p> {!! pll_current_language('slug')==='vi' ? 'Hệ:' : 'Mode:'!!} {{ get_field('mode_detail')}}</p>
                                <p> {!! pll_current_language('slug')==='vi' ? 'Thời gian ra mắt:' : 'Time launch:'!!} {{ get_field('time_launch')}}</p>
                            </div>
                        </div>
                        <div class="content-dropdown">
                            @php
                            $get_field = get_field('detali_specialized_1-1');
                            if($get_field != ''):
                            @endphp
                            <div class="single-dropdown">
                                <p id="year_1" class="click_advance"> {!! pll_current_language('slug')==='vi' ? 'Năm nhất:' : ' School Year 1:'!!} <i class="fa fa-plus"></i></p>
                                <div class="display_advance">
                                    <div class="main-content-course">
                                        <div class="semeter semeter1">
                                            <h6> {!! pll_current_language('slug')==='vi' ? 'Kỳ 1:' : 'Semesters 1:'!!}</h6>
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <ul class="list-drop list-drop1">
                                            @php
                                            $get_field = get_field('detali_specialized_1-1');
                                            @endphp
                                            @foreach($get_field as $value)
                                            <li><a href="{{ get_the_permalink($value->ID)}}">{{ $value->post_title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @php
                                    $get_field = get_field('detali_specialized_1-2');
                                    if($get_field != ''):
                                    @endphp
                                    <div class="main-content-course">
                                        <div class="semeter semeter2">
                                            <h6> {!! pll_current_language('slug')==='vi' ? 'Kỳ 2:' : 'Semesters 2:'!!}</h6>
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <ul class="list-drop list-drop2">
                                            @php
                                            $get_field = get_field('detali_specialized_1-2');
                                            @endphp
                                            @foreach($get_field as $value)
                                            <li><a href="{{ get_the_permalink($value->ID)}}">{{ $value->post_title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @php
                                    endif;
                                    @endphp
                                    @php
                                    $get_field = get_field('detali_specialized_1-3');
                                    if($get_field != '') :
                                    @endphp
                                    <div class="main-content-course">
                                        <div class="semeter semeter3">
                                            <h6> {!! pll_current_language('slug')==='vi' ? 'Kỳ 3:' : 'Semesters 3:'!!}</h6>
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <ul class="list-drop list-drop3">
                                            @php
                                            $get_field = get_field('detali_specialized_1-3');
                                            @endphp
                                            @foreach($get_field as $value)
                                            <li><a href="{{ get_the_permalink($value->ID)}}">{{ $value->post_title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @php
                                    endif;
                                    @endphp
                                </div>
                            </div>
                            @php
                            endif;
                            @endphp
                            @php
                            $get_field = get_field('detali_specialized_2-1');
                            if($get_field != '') :
                            @endphp
                            <div class="single-dropdown">
                                <p id="year_2" class="click_advance1"> {!! pll_current_language('slug')==='vi' ? 'Năm 2:' : 'School Year 2:'!!}<i class="fa fa-plus"></i></p>
                                <div class="display_advance1">
                                    <div class="main-content-course">
                                        <div class="semeter semeter1">
                                            <h6> {!! pll_current_language('slug')==='vi' ? 'Kỳ 1:' : 'Semesters 1:'!!}</h6>
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <ul class="list-drop list-drop1">
                                            @php
                                            $get_field = get_field('detali_specialized_2-1');
                                            @endphp
                                            @foreach($get_field as $value)
                                            <li><a href="{{ get_the_permalink($value->ID)}}">{{ $value->post_title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @php
                                    $get_field = get_field('detali_specialized_2-2');
                                    if($get_field != '') :
                                    @endphp
                                    <div class="main-content-course">
                                        <div class="semeter semeter2">
                                            <h6> {!! pll_current_language('slug')==='vi' ? 'Kỳ 2:' : 'Semesters 2:'!!}</h6>
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <ul class="list-drop list-drop2">
                                            @php
                                            $get_field = get_field('detali_specialized_2-2');
                                            @endphp
                                            @foreach($get_field as $value)
                                            <li><a href="{{ get_the_permalink($value->ID)}}">{{ $value->post_title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @php
                                    endif;
                                    @endphp
                                    @php
                                    $get_field = get_field('detali_specialized_2-3');
                                    if($get_field != '') :
                                    @endphp
                                    <div class="main-content-course">
                                        <div class="semeter semeter3">
                                            <h6> {!! pll_current_language('slug')==='vi' ? 'Kỳ 3:' : 'Semesters 3:'!!} </h6>
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <ul class="list-drop list-drop3">
                                            @php
                                            $get_field = get_field('detali_specialized_2-3');
                                            @endphp
                                            @foreach($get_field as $value)
                                            <li><a href="{{ get_the_permalink($value->ID)}}">{{ $value->post_title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @php
                                    endif;
                                    @endphp
                                </div>
                            </div>
                            @php
                            endif;
                            @endphp
                            @php
                            $get_field = get_field('detali_specialized_3-1');
                            if($get_field != '') :
                            @endphp
                            <div class="single-dropdown">
                                <p id="year_3" class="click_advance2"> {!! pll_current_language('slug')==='vi' ? 'Năm 3:' : 'School Year 3:'!!} <i class="fa fa-plus"></i></p>
                                <div class="display_advance2">
                                    <div class="main-content-course">
                                        <div class="semeter semeter1">
                                            <h6> {!! pll_current_language('slug')==='vi' ? 'Kỳ 1:' : 'Semesters 1:'!!} </h6>
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <ul class="list-drop list-drop1">
                                            @php
                                            $get_field = get_field('detali_specialized_3-1');
                                            @endphp
                                            @foreach($get_field as $value)
                                            <li><a href="{{ get_the_permalink($value->ID)}}">{{ $value->post_title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @php
                                    $get_field = get_field('detali_specialized_3-2');
                                    if($get_field != '') :
                                    @endphp
                                    <div class="main-content-course">
                                        <div class="semeter semeter2">
                                            <h6> {!! pll_current_language('slug')==='vi' ? 'Kỳ 2:' : 'Semesters 2:'!!} </h6>
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <ul class="list-drop list-drop2">
                                            @php
                                            $get_field = get_field('detali_specialized_3-2');
                                            @endphp
                                            @foreach($get_field as $value)
                                            <li><a href="{{ get_the_permalink($value->ID)}}">{{ $value->post_title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @php
                                    endif;
                                    @endphp
                                    @php
                                    $get_field = get_field('detali_specialized_3-3');
                                    if($get_field != '') :
                                    @endphp
                                    <div class="main-content-course">
                                        <div class="semeter semeter3">
                                            <h6> {!! pll_current_language('slug')==='vi' ? 'Kỳ 3:' : 'Semesters 3:'!!} </h6>
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <ul class="list-drop list-drop3">
                                            @php
                                            $get_field = get_field('detali_specialized_3-3');
                                            @endphp
                                            @foreach($get_field as $value)
                                            <li><a href="{{ get_the_permalink($value->ID)}}">{{ $value->post_title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @php
                                    endif;
                                    @endphp
                                </div>
                            </div>
                            @php
                            endif;
                            @endphp
                            @php
                            $get_field = get_field('detali_specialized_4-1');
                            if($get_field != '') :
                            @endphp
                            <div class="single-dropdown">
                                <p id="year_4" class="click_advance3"> {!! pll_current_language('slug')==='vi' ? 'Năm 4:' : 'School Year 4:'!!}<i class="fa fa-plus"></i></p>
                                <div class="display_advance3">
                                    <div class="main-content-course">
                                        <div class="semeter semeter1">
                                            <h6> {!! pll_current_language('slug')==='vi' ? 'Kỳ 1:' : 'Semesters 1:'!!} </h6>
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <ul class="list-drop list-drop1">
                                            @php
                                            $get_field = get_field('detali_specialized_4-1');
                                            @endphp
                                            @foreach($get_field as $value)
                                            <li><a href="{{ get_the_permalink($value->ID)}}">{{ $value->post_title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @php
                                    $get_field = get_field('detali_specialized_4-2');
                                    if($get_field != '') :
                                    @endphp
                                    <div class="main-content-course">
                                        <div class="semeter semeter2">
                                            <h6> {!! pll_current_language('slug')==='vi' ? 'Kỳ 2:' : 'Semesters 2:'!!} </h6>
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <ul class="list-drop list-drop2">
                                            @php
                                            $get_field = get_field('detali_specialized_4-2');
                                            @endphp
                                            @foreach($get_field as $value)
                                            <li><a href="{{ get_the_permalink($value->ID)}}">{{ $value->post_title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @php
                                    endif;
                                    @endphp
                                    @php
                                    $get_field = get_field('detali_specialized_4-3');
                                    if($get_field != '') :
                                    @endphp
                                    <div class="main-content-course">
                                        <div class="semeter semeter3">
                                            <h6> {!! pll_current_language('slug')==='vi' ? 'Kỳ 3:' : 'Semesters 3:'!!} </h6>
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <ul class="list-drop list-drop3">
                                            @php
                                            $get_field = get_field('detali_specialized_4-3');
                                            @endphp
                                            @foreach($get_field as $value)
                                            <li><a href="{{ get_the_permalink($value->ID)}}">{{ $value->post_title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @php
                                    endif;
                                    @endphp
                                </div>
                            </div>
                            @php
                            endif;
                            @endphp
                            <div class="career">
                                <div class="single-dropdown">
                                    <p id="year_5" class="click_advance4 career_dropdown"> {!! pll_current_language('slug')==='vi' ? 'Cơ hội nghề nghiệp' : 'Career Opportunities'!!}<i class="fa fa-plus"></i></p>
                                    <div class="display_advance4">
                                        <div class="main-content-course course_nopd">
                                            <div class="semeter semeter1 no_flex">
                                                {!! get_field('career_opportunities') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="assessment">
                                <div class="single-dropdown">
                                    <p id="year_6" class=" click_advance5 career_dropdown"> {!! pll_current_language('slug')==='vi' ? 'Nội dung đào tạo' : 'Education program'!!}<i class="fa fa-plus"></i></p>
                                    <div class="display_advance5">
                                        <div class="main-content-course course_nopd">
                                            <div class="semeter semeter1 no_flex">
                                                {!! get_field('learning') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="outcomes">
                                <div class="single-dropdown">
                                    <p id="year_7" class="click_advance6 career_dropdown"> {!! pll_current_language('slug')==='vi' ? 'Chuẩn đầu ra' : 'Course Learning Outcomes'!!}<i class="fa fa-plus"></i></p>
                                    <div class="display_advance6">
                                        <div class="main-content-course course_nopd">
                                            <div class="semeter semeter1 no_flex">
                                                {!! get_field('course_learning_outcomes') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="business_connection">
                                <div class="single-dropdown">
                                    <p id="year_8" class="click_advance7 career_dropdown"> {!! pll_current_language('slug')==='vi' ? 'Kết nối doanh nghiệp' : 'Business connection'!!}<i class="fa fa-plus"></i></p>
                                    <div class="display_advance7">
                                        <div class="main-content-course course_nopd">
                                            <div class="semeter semeter1 no_flex">
                                                {!! get_field('course_business_connection') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="student-work single-work">
                        <h3> {!! pll_current_language('slug')==='vi' ? 'Thành quả học sinh' : 'Student Work'!!}</h3>
                        <div class="slider-student">
                            <div> <img src="{{ get_field('slider_image1') }}" alt="hr"></div>
                            <div> <img src="{{ get_field('slider_image2') }}" alt="hr"></div>
                            <div> <img src="{{ get_field('slider_image3') }}" alt="hr"></div>
                        </div>
                    </div>
                    <div class="how-to">
                        <h3> {!! pll_current_language('slug')==='vi' ? 'Đăng ký nhập học' : 'How to apply'!!}</h3>
                        <div class="start-discover">
                            <div class="icon-apply">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <span>{{ get_field('how_to_app')}}</span>
                            </div>
                            <div class="target-link">
                                <a> {!! pll_current_language('slug')==='vi' ? 'khám phá' : 'discover'!!}</a>
                            </div>
                        </div>
                        <ol class="list-ol display-none">
                            <li class="no-border"><a> {!! pll_current_language('slug')==='vi' ? 'Email: swinburne@fe.edu.vn' : 'Email us: swinburne@fe.edu.vn'!!} </a></li>
                            <li class="call-last"><a>Call us: 0936489333</a></li>
                        </ol>

                    </div>
                </div>
            </div>
            
            <div class="col-lg-3">
                <div class="sidebar">
                    @php
                        $category_download = '';

                        //lấy link downlad tài liệu từng khóa học
                        $sort_url_cource = explode('/', $_SERVER["REQUEST_URI"]);
                        $download_course_all = (pll_current_language('slug') === 'vi') ? $sort_url_cource[2] : $sort_url_cource[3];
                        if (pll_current_language('slug') === 'vi') {
                            $category_download = get_term_by('slug', $download_course_all, 'list-downloads');
                            if(isset($category_download) && !empty($category_download)) {
                                $category_id_download = $category_download->term_id;
                                $link_cource_download = get_term_link($query->ID);
                            }
                            
                        } else {
                            $category_download = get_term_by('slug', $download_course_all, 'list-downloads');
                            if(isset($category_download) && !empty($category_download)) {
                                $category_id_download = $category_download->term_id;
                                $link_cource_download = get_term_link($query->ID);
                                }
                        }
                    @endphp
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
                                        <a href="{!! $link_cource_download !!}">{!! pll_current_language('slug')==='vi' ? 'Tải tài liệu' : 'Download the issue'!!} <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
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