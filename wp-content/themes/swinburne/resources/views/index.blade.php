@extends('layouts.app')
@section('content')

<div class="banner-main">
    @php
    $highlight = [
        'posts_per_page' => 2,
        'meta_key' => 'highlight',
        'meta_value' => 'yes',
        'post_type' => 'news',
    ];
    $banners = new WP_Query($highlight);
    $i=1;
    
    @endphp
    @if ($banners->have_posts())
    @while ($banners->have_posts())
        @php
        $banners->the_post();
        $key= get_post_meta( get_the_ID(),'highlight', false );
        
        @endphp
    <div class="banner-home fixheight custom-bn" style="background-image: url('{!! pll_current_language('slug')==='vi' ? (($i==1) ? get_option('banner_home_vi') : get_option('banner_home_vi2')) : (($i==1) ? get_option('banner_home') : get_option('banner_home2')) !!}');">
        
        <div class="hide-destop">
            <img src="{!! pll_current_language('slug')==='vi' ? (($i==1) ? get_option('banner_home_vi') : get_option('banner_home_vi2')) : (($i==1) ? get_option('banner_home') : get_option('banner_home2')) !!}" alt="banner">
        </div>
        <div class="container custom-width">
            <div class="text-banner hide-mobile">
                <div class="all-content-out">
                    <div class="content-out">
                        <div class="content-out-title"><a href="{{ get_the_permalink()}}"> {!! wp_trim_words(get_the_title(), $num_words = 22) !!}</a></div>
                        <p>{!! wp_trim_words(get_field('custom_descript_single_post'), $num_words = 25) !!}</p>
                        <div class="read-more">
                            <a href="{{ get_the_permalink()}}">{!! pll_current_language('slug')==='vi' ? 'Xem thêm' : 'Read more'!!}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $i++;
    @endphp
    @endwhile
     @endif
</div>
<div class="selling-point">
    <div class="container">
        @php
        $query_obj = get_queried_object();
        $selling_title = get_field('selling_title', $query_obj);
        @endphp
        <h2 class="selling-title">
            {{ $selling_title }}
        </h2>
        <div class="nf-row row">
            
                
                @php
                
                    if( have_rows('selling_points', $query_obj) ):

                    // Loop through rows.
                    while( have_rows('selling_points', $query_obj) ) : the_row();
                    @endphp
                        <div class="nf-col nf-col-2 col-sm-12 col-12">
                            @php
                                $selling_icon = get_sub_field('selling_icon');
                                $selling_content = get_sub_field('selling_content');
                            @endphp
                            <div class="box-content">
                                <div class="box-icon">
                                    <img src="{{$selling_icon}}" alt="icon">
                                </div>
                                <p>{{$selling_content}}</p>
                            </div>
                        </div>
                    @php
                    // End loop.
                    endwhile;
                    // Do something...
                    endif;
                @endphp     
        </div>
    </div>
</div>
<div class="find-course">
    <div class="container">
        <h2>{!! pll_current_language('slug')==='vi' ? 'TÌM KHÓA HỌC' : ' FIND A COURSE'!!}</h2>
        <div class="course-group">
            <div class="row">
                @foreach ($terms as $value)
                @php
                if (function_exists('z_taxonomy_image_url')) {
                $img = z_taxonomy_image_url($value->term_id);
                } else {
                $img = '';
                }
                @endphp
                <div class="col-lg-3">
                    <div class="single-course">
                        <div class="course-img">
                            <img src="{{get_field('image_course', $value->taxonomy.'_'.$value->term_id)}}" alt="hr">
                        </div>
                        <div class="course-content">
                            <h4><a href="{{ get_term_link($value->term_id) }}">{{ $value->name }}</a></h4>
                            <div class="separa"></div>
                            <p>{!! wp_trim_words($value->description, $num_words = 10) !!}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="tab-future">
    <!-- Nav tabs -->
    <div class="list-tab">
        <div class="container">
            <ul class="nav nav-tabs tab-homepage" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home"> {!! pll_current_language('slug')==='vi' ? 'Sinh viên hiện tại' : 'Current students '!!}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1"> {!! pll_current_language('slug')==='vi' ? 'Sinh viên tương lai' : 'Future students'!!}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2"> {!! pll_current_language('slug')==='vi' ? 'Nghiên cứu sinh' : 'Research students'!!}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu3"> {!! pll_current_language('slug')==='vi' ? 'Cựu sinh viên' : 'Graduates & Alumni'!!}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Tab panes -->
    <div class="tab-content">
        <div id="home" class="container tab-pane active">
            <div class="all-content">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-xs-6 no-pd">
                        <div class="detail-single">
                            <h4>{!! pll_current_language('slug')==='vi' ? get_option('study_tool_tab1_vi') : get_option('study_tool_tab1')!!}</h4>
                            <ul class="blue-link">
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item1_tab1_link_vi') : get_option('study_item1_tab1_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item1_tab1_vi') : get_option('study_item1_tab1') !!}</a></li>
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item2_tab1_link_vi') : get_option('study_item2_tab1_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item2_tab1_vi') : get_option('study_item2_tab1') !!}</a></li>
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item3_tab1_link_vi') : get_option('study_item3_tab1_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item3_tab1_vi') : get_option('study_item3_tab1') !!}</a></li>
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item4_tab1_link_vi') : get_option('study_item4_tab1_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item4_tab1_vi') : get_option('study_item4_tab1') !!}</a></li>
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item5_tab1_link_vi') : get_option('study_item5_tab1_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item5_tab1_vi') : get_option('study_item5_tab1') !!}</a></li>
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item6_tab1_link_vi') : get_option('study_item6_tab1_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item6_tab1_vi') : get_option('study_item6_tab1') !!}</a></li>
                            </ul>
                        </div>
                    </div>
                   <div class="col-lg-3 col-md-12 col-xs-6 no-pd">
                        <div class="detail-single small-width">
                            <h4>{!! pll_current_language('slug')==='vi' ? get_option('service_title_tab1_vi') : get_option('service_title_tab1')!!}</h4>
                            <ul class="blue-link">
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item1_tab1_link_vi') : get_option('service_item1_tab1_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item1_tab1_vi') : get_option('service_item1_tab1') !!}</a></li>
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item2_tab1_link_vi') : get_option('service_item2_tab1_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item2_tab1_vi') : get_option('service_item2_tab1') !!}</a></li>
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item3_tab1_link_vi') : get_option('service_item3_tab1_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item3_tab1_vi') : get_option('service_item3_tab1') !!}</a></li>
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item4_tab1_link_vi') : get_option('service_item4_tab1_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item4_tab1_vi') : get_option('service_item4_tab1') !!}</a></li>
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item5_tab1_link_vi') : get_option('service_item5_tab1_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item5_tab1_vi') : get_option('service_item5_tab1') !!}</a></li>
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item6_tab1_link_vi') : get_option('service_item6_tab1_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item6_tab1_vi') : get_option('service_item6_tab1') !!}</a></li>
                            </ul>
                        </div>
                    </div>
                   <div class="col-lg-3 col-md-12 col-xs-6 no-pd">
                        <div class="detail-single">

                              <h4>{!! pll_current_language('slug')==='vi' ? get_option('service_title_tab1_vi') : get_option('service_title_tab1')!!}</h4>
                            <p>
                            {{wp_trim_words(pll_current_language('slug')==='vi' ? get_option('service_content_tab1_vi') : get_option('service_content_tab1'), $num_words = 30)}}
                            </p>

                            <h6> <a href="{!! pll_current_language('slug')==='vi' ? get_option('find_out_tab1_vi') : get_option('find_out_tab1') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>
                                {!! pll_current_language('slug')==='vi' ? get_option('see_more_tab1_vi') : get_option('see_more_tab1')!!}

                            </a></h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-xs-6 no-pd">
                        <div class="tab-small-img">
                            <img src="{!! get_option('graduate_img_tab1')!!}" alt="hr">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu1" class="container tab-pane fade">
            <div class="all-content">
                <div class="row">
                   <div class="col-lg-3 col-md-12 col-xs-6 no-pd">
                        <div class="detail-single">
                            <h4>{!! pll_current_language('slug')==='vi' ? get_option('study_tool_tab2_vi') : get_option('study_tool_tab2')!!}</h4>
                            <ul class="blue-link">
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item1_tab2_link_vi') : get_option('study_item1_tab2_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item1_tab2_vi') : get_option('study_item1_tab1') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item2_tab2_link_vi') : get_option('study_item2_tab2_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item2_tab2_vi') : get_option('study_item2_tab2') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item3_tab2_link_vi') : get_option('study_item3_tab2_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item3_tab2_vi') : get_option('study_item3_tab2') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item4_tab2_link_vi') : get_option('study_item4_tab2_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item4_tab2_vi') : get_option('study_item4_tab1') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item5_tab2_link_vi') : get_option('study_item5_tab2_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item5_tab2_vi') : get_option('study_item5_tab2') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item6_tab2_link_vi') : get_option('study_item6_tab2_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item6_tab2_vi') : get_option('study_item6_tab2') !!}</a></li>
                            </ul>
                        </div>
                    </div>
                   <div class="col-lg-3 col-md-12 col-xs-6 no-pd">
                        <div class="detail-single small-width">
                            <h4>{!! pll_current_language('slug')==='vi' ? get_option('service_title_tab2_vi') : get_option('service_title_tab2')!!}</h4>
                            <ul class="blue-link">
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item1_tab2_link_vi') : get_option('service_item1_tab2_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item1_tab2_vi') : get_option('service_item1_tab2') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item2_tab2_link_vi') : get_option('service_item2_tab2_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item2_tab2_vi') : get_option('service_item2_tab2') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item3_tab2_link_vi') : get_option('service_item3_tab2_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item3_tab2_vi') : get_option('service_item3_tab2') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item4_tab2_link_vi') : get_option('service_item4_tab2_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item4_tab2_vi') : get_option('service_item4_tab2') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item5_tab2_link_vi') : get_option('service_item5_tab2_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item5_tab2_vi') : get_option('service_item5_tab2') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item6_tab2_link_vi') : get_option('service_item6_tab2_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item6_tab2_vi') : get_option('service_item6_tab2') !!}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-xs-6 no-pd">
                        <div class="detail-single">
                              <h4>{!! pll_current_language('slug')==='vi' ? get_option('service_title_tab2_vi') : get_option('service_title_tab2')!!}</h4>
                            <p>
                            {{wp_trim_words(pll_current_language('slug')==='vi' ? get_option('service_content_tab2_vi') : get_option('service_content_tab2'), $num_words = 30)}}
                            </p>
                            <h6> <a href="{!! pll_current_language('slug')==='vi' ? get_option('find_out_tab2_vi') : get_option('find_out_tab2') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>
                                {!! pll_current_language('slug')==='vi' ? get_option('see_more_tab2_vi') : get_option('see_more_tab2')!!}

                            </a></h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-xs-6 no-pd">
                        <div class="tab-small-img">
                            <img src="{!! get_option('graduate_img_tab2')!!}" alt="hr">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu2" class="container tab-pane fade">
            <div class="all-content">
                <div class="row">
                   <div class="col-lg-3 col-md-12 col-xs-6 no-pd">
                        <div class="detail-single">
                            <h4>{!! pll_current_language('slug')==='vi' ? get_option('study_tool_tab3_vi') : get_option('study_tool_tab3')!!}</h4>
                            <ul class="blue-link">
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item1_tab3_link_vi') : get_option('study_item1_tab3_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item1_tab3_vi') : get_option('study_item1_tab3') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item2_tab3_link_vi') : get_option('study_item2_tab3_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item2_tab3_vi') : get_option('study_item2_tab3') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item3_tab3_link_vi') : get_option('study_item3_tab3_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item3_tab3_vi') : get_option('study_item3_tab3') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item4_tab3_link_vi') : get_option('study_item4_tab3_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item4_tab3_vi') : get_option('study_item4_tab3') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item5_tab3_link_vi') : get_option('study_item5_tab3_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item5_tab3_vi') : get_option('study_item5_tab3') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item6_tab3_link_vi') : get_option('study_item6_tab3_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item6_tab3_vi') : get_option('study_item6_tab3') !!}</a></li>
                            </ul>
                        </div>
                    </div>
                   <div class="col-lg-3 col-md-12 col-xs-6 no-pd">
                        <div class="detail-single small-width">
                            <h4>{!! pll_current_language('slug')==='vi' ? get_option('service_title_tab3_vi') : get_option('service_title_tab3')!!}</h4>
                            <ul class="blue-link">
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item1_tab3_link_vi') : get_option('service_item1_tab3_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item1_tab3_vi') : get_option('service_item1_tab3') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item2_tab3_link_vi') : get_option('service_item2_tab3_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item2_tab3_vi') : get_option('service_item2_tab3') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item3_tab3_link_vi') : get_option('service_item3_tab3_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item3_tab3_vi') : get_option('service_item3_tab3') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item4_tab3_link_vi') : get_option('service_item4_tab3_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item4_tab3_vi') : get_option('service_item4_tab3') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item5_tab3_link_vi') : get_option('service_item5_tab3_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item5_tab3_vi') : get_option('service_item5_tab3') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item6_tab3_link_vi') : get_option('service_item6_tab3_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item6_tab3_vi') : get_option('service_item6_tab3') !!}</a></li>
                            </ul>
                        </div>
                    </div>
                   <div class="col-lg-3 col-md-12 col-xs-6 no-pd">
                        <div class="detail-single">
                             <h4>{!! pll_current_language('slug')==='vi' ? get_option('service_title_tab3_vi') : get_option('service_title_tab3')!!}</h4>
                            <p>
                            {{wp_trim_words(pll_current_language('slug')==='vi' ? get_option('service_content_tab3_vi') : get_option('service_content_tab3'), $num_words = 30)}}
                            </p>
                            <h6> <a href="{!! pll_current_language('slug')==='vi' ? get_option('find_out_tab3_vi') : get_option('find_out_tab3') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>
                                {!! pll_current_language('slug')==='vi' ? get_option('see_more_tab3_vi') : get_option('see_more_tab3')!!}

                            </a></h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-xs-6 no-pd">
                        <div class="tab-small-img">
                            <img src="{!! get_option('graduate_img_tab3')!!}" alt="hr">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu3" class="container tab-pane fade">
            <div class="all-content">
                <div class="row">
                   <div class="col-lg-3 col-md-12 col-xs-6 no-pd">
                        <div class="detail-single">
                            <h4>{!! pll_current_language('slug')==='vi' ? get_option('study_tool_tab4_vi') : get_option('study_tool_tab4')!!}</h4>
                            <ul class="blue-link">
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item1_tab4_link_vi') : get_option('study_item1_tab4_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item4_tab4_vi') : get_option('study_item1_tab4') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item2_tab4_link_vi') : get_option('study_item2_tab4_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item2_tab4_vi') : get_option('study_item2_tab4') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item3_tab4_link_vi') : get_option('study_item3_tab4_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item3_tab4_vi') : get_option('study_item3_tab4') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item4_tab4_link_vi') : get_option('study_item4_tab4_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item4_tab4_vi') : get_option('study_item4_tab4') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item5_tab4_link_vi') : get_option('study_item5_tab4_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item5_tab4_vi') : get_option('study_item5_tab4') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('study_item6_tab4_link_vi') : get_option('study_item6_tab4_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('study_item6_tab4_vi') : get_option('study_item6_tab4') !!}</a></li>
                            </ul>
                        </div>
                    </div>
                  <div class="col-lg-3 col-md-12 col-xs-6 no-pd">
                        <div class="detail-single small-width">
                            <h4>{!! pll_current_language('slug')==='vi' ? get_option('service_title_tab4_vi') : get_option('service_title_tab4')!!}</h4>
                            <ul class="blue-link">
                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item1_tab4_link_vi') : get_option('service_item1_tab4_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item1_tab4_vi') : get_option('service_item1_tab4') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item2_tab4_link_vi') : get_option('service_item2_tab4_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item2_tab4_vi') : get_option('service_item2_tab4') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item3_tab4_link_vi') : get_option('service_item3_tab4_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item3_tab4_vi') : get_option('service_item3_tab4') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item4_tab4_link_vi') : get_option('service_item4_tab1_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item4_tab4_vi') : get_option('service_item4_tab4') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item5_tab4_link_vi') : get_option('service_item5_tab4_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item5_tab4_vi') : get_option('service_item5_tab4') !!}</a></li>

                                <li><a href="{!! pll_current_language('slug')==='vi' ? get_option('service_item6_tab4_link_vi') : get_option('service_item6_tab4_link') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('service_item6_tab4_vi') : get_option('service_item6_tab4') !!}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-xs-6 no-pd">
                        <div class="detail-single">
                             <h4>{!! pll_current_language('slug')==='vi' ? get_option('service_title_tab4_vi') : get_option('service_title_tab4')!!}</h4>
                           <p>
                            {{wp_trim_words(pll_current_language('slug')==='vi' ? get_option('service_content_tab4_vi') : get_option('service_content_tab4'), $num_words = 30)}}
                            </p>
                            <h6> <a href="{!! pll_current_language('slug')==='vi' ? get_option('find_out_tab4_vi') : get_option('find_out_tab4') !!}"><i class="fa fa-chevron-right" aria-hidden="true"></i>
                                {!! pll_current_language('slug')==='vi' ? get_option('see_more_tab4_vi') : get_option('see_more_tab4')!!}

                            </a></h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-xs-6 no-pd">
                        <div class="tab-small-img">
                            <img src="{!! get_option('graduate_img_tab4')!!}" alt="hr">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="news-home">
    <div class="container">
        <div class="main-news">
            <h2> {!! pll_current_language('slug')==='vi' ? 'Tin tức' : 'News'!!}</h2>
            <div class="row">
                <div class="col-lg-7">
                    <div class="posts">
                        <div class="fist-post">
                           
                            <a href="{!! get_the_permalink($latest_books_post1->ID) !!}">
                                <div class="img-news" style="background-image: url('{{ $thumbnail_url_post }}');">

                                </div>
                            </a>
                            <div class="news-cont">
                                <div class="title-news">
                                    <a href="{!! get_the_permalink($latest_books_post1->ID) !!}">{{ $latest_books_post1->post_title }}</a>
                                </div>
                                <div class="para-news">
                                    {!! get_field('custom_descript_single_post', $latest_books_post1->ID) !!}
                                </div>
                            </div>
                        </div>
                        <div class="sli-news">
                            <div class="your-class">
                                @foreach($sliced_array_post as $value)
                                @php
                                $loop_id = $value->ID;
                                $thumbnail_url_looppp = get_the_post_thumbnail_url($loop_id);
                                @endphp
                                <div class="single-slider">
                                    <a href="{{ get_the_permalink($value->ID)}}">
                                        <div class="slider-img" style="background-image: url('{{ $thumbnail_url_looppp }}');">

                                        </div>
                                    </a>
                                    <div class="slider-title">
                                        <h4><a href="{{ get_the_permalink($value->ID) }}">{{ $value->post_title }}</a></h4>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="dream-img">
						<a href="{!! get_option('image_poster_link') !!}" target="_blank"><img src="{{ pll_current_language('slug')==='vi' ? get_field('anh_dai_dien_hoc_cung_chung_toi', 94) : get_field('photos_representative_study', 94) }}" alt="hr"></a>                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="event-home wow slideInLeft" data-wow-duration="2s">
    <div class="container">
        <div class="slider-event">
            <div class="row">
                <div class="col-lg-6 col-md-12 no-padding">
                    <div class="title-discv">
                        <h2> {!! pll_current_language('slug')==='vi' ? 'SỰ KIỆN' : 'EVENTS'!!}</h2>
                        <div class="link-go none-link-go">
                            <a href="{{ site_url('events') }}">discover<i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="single-post-items">
                        <div class="single-post-img">
                            <a href="{{get_the_permalink($latest_books_event1->ID)  }}">
                                <div class="head-image" style="background-image: url('{{ $thumbnail_url }}');">

                                </div>
                            </a>
                            <h2><a href="{{ get_the_permalink($latest_books_event1->ID) }}">{{ $latest_books_event1->post_title }} </a></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 no-padding between-bg">
                    <div class="single-post-items smaller">
                        <div class="single-post-img has-pd">
                            <a href="{{ get_the_permalink($latest_books_event2->ID) }}">
                                <div class="single-head-img" style="background-image: url('{{ $thumbnail_url2 }}');">

                                </div>
                            </a>
                            <div class="content-sli">
                                <h2><a href="{{ get_the_permalink($latest_books_event2->ID) }}">{{ $latest_books_event2->post_title }}</a></h2>
                                <p> {!! wp_trim_words($latest_books_event2->post_content, $num_words = 20) !!}</p>
                                <div class="read-more-link">
                                    <a href="{{ get_the_permalink($latest_books_event2->ID) }}"> {!! pll_current_language('slug')==='vi' ? 'Xem thêm' : 'Read more'!!}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 no-padding">
                    <div class="link-go none-mobile">
                        <a href="{{ site_url('events') }}"> {!! pll_current_language('slug')==='vi' ? 'khám phá' : 'discover'!!}<i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </div>
                    <div class="all-items-sli">
                        <div class="single-post-items smaller single-slider-post">
                            @foreach($sliced_array as $value)
                            @php
                            $loop_id = $value->ID;
                            $thumbnail_url_looppp = get_the_post_thumbnail_url($loop_id);
                            @endphp
                            <div class="single-post-img">
                                <a href="{{ get_the_permalink($value->ID) }}">
                                    <div class="img-head" style="background-image: url('{{ $thumbnail_url_looppp }}');">

                                    </div>
                                </a>
                                <div class="content-sli">
                                    <h2><a href="{{ get_the_permalink($value->ID) }}">{{ $value->post_title }} </a></h2>
                                    <p>{!! wp_trim_words($value->post_content, $num_words = 20) !!}</p>
                                    <div class="read-more-link">
                                        <a href="{{ get_the_permalink($value->ID) }}"> {!! pll_current_language('slug')==='vi' ? 'Xem thêm' : 'Read more'!!}</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection