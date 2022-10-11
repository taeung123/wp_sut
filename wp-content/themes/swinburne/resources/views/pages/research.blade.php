@extends('layouts.app')
@section('content')
    <div class="navbar-study">
        <section class="top-nav custom_nav">
            <div class="container fix-height">
                <input id="menu-toggle" type="checkbox" />
                <label class='menu-button-container' for="menu-toggle">
                    <div class='menu-button'></div>
                </label>
                <div class="menu-wrapper">
                    <ul class="menu menu-nav finel-nav" id="nav-business">
                        @foreach ($terms_research as $key => $value)
                            @if ($key < 7)
                                <?php
                                $term_id = $value->term_id;
                                $taxonomy_name = 'list-research';
                                $termchildren = get_term_children($term_id, $taxonomy_name);
                                ?>
                                <li><a href="{{ get_term_link($value->term_id) }}">{{ $value->name }}

                                        @if ($termchildren)
                                            <span class="cs-menu-toggle"><i class="fa fa-angle-down"></i></span>
                                        @endif
                                    </a>
                                    @if ($termchildren)
                                        <span class="sub-menu-button">+</span>


                                        <div class="dropdown-content">
                                            <div class="container">
                                                <div class="header">
                                                    <h2>{{ $value->name }}</h2>
                                                </div>
                                                <hr>
                                                <div class="row wapper-mega-menu">
                                                    @foreach ($termchildren as $child)
                                                        <?php $term = get_term_by('id', $child, $taxonomy_name); ?>
                                                        <div class="col-12 col-lg-4">
                                                            <a
                                                                href="{{ get_term_link($child, $taxonomy_name) }}">{{ $term->name }}</a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </div>
    <div class="about-page research-custom">
        <div class="banner-about fixheight" style="background-image: url('{{ get_option('research_banner') }}');">

        </div>
        <div class="about-us">
            <div class="container">
                <div class="main-about main-research">
                    <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                    <hr>
                    <h1>{!! $object_current->post_title !!}</h1>
                    <div>

                        {!! apply_filters('the_content', $object_current->post_content) !!}
                    </div>
                    <div class="list-posts-about">
                        <div class="row">
                            @foreach ($terms_research as $value)
                                @php
                                    if (function_exists('z_taxonomy_image_url')) {
                                        $img_research = z_taxonomy_image_url($value->term_id);
                                    } else {
                                        $img_research = '';
                                    }
                                    $custom_link = get_field('custom_link', $value);
                                @endphp
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="single-post-about">
                                        <a
                                            href="{{ !empty($custom_link) || $custom_link != '' ? $custom_link : get_term_link($value->term_id) }}">
                                            <div class="img-posts-about"
                                                style="background-image: url('{{ $img_research }}');">

                                            </div>
                                        </a>
                                        <div class="content-posts-about">
                                            <h2><a
                                                    href="{{ !empty($custom_link) || $custom_link != '' ? $custom_link : get_term_link($value->term_id) }}">{{ $value->name }}</a>
                                            </h2>
                                            <div class="descrip-abouts">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @php
                        if (pll_current_language('slug') === 'vi') {
                            $term = 'nghien-cuu';
                        } else {
                            $term = 'research';
                        }
                        $arr_term = [];
                        $i = 0;
                        foreach ($terms_research as $value) {
                            $arr_term[$i] = $value->slug;
                            $i++;
                        }
                        
                        $query_tag = new WP_Query([
                            'post_type' => 'news',
                            'posts_per_page' => -1,
                            'order ' => 'DESC',
                            'tax_query' => [
                                [
                                    'taxonomy' => 'list-news',
                                    'field' => 'slug',
                                    'terms' => [$arr_term],
                                ],
                            ],
                        ]);
                    @endphp
                    @if ($query_tag->post_count > 0)
                        <div class="show-post-news">
                            <div class="university-area list-post-news">
                                <h2>{!! pll_current_language('slug') === 'vi' ? 'Tin tức' : 'News' !!}</h2>
                                <div class="list-posts-about">
                                    <div class="row">
                                        @php
                                        @endphp
                                        @foreach ($query_tag->posts as $value)
                                            @php
                                                
                                                $loop_id = $value->ID;
                                                $thumbnail_url_looppp = get_the_post_thumbnail_url($loop_id);
                                            @endphp
                                            <div class="col-lg-4 col-md-6 col-12">
                                                <div class="single-post-about">
                                                    <a href="{!! $value->guid !!}">
                                                        <div class="img-posts-about list-post-news"
                                                            style="background-image: url('{{ $thumbnail_url_looppp }}');">

                                                        </div>
                                                    </a>
                                                    <div class="content-posts-about">
                                                        <h4><a
                                                                href="{!! $value->guid !!}">{{ $value->post_title }}</a>
                                                        </h4>
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
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
