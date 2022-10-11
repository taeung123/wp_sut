@extends('layouts.app')
@section('content')
    @php
    $args_soft_new = [
        'taxonomy' => 'list-news',
        'hide_empty' => false,
        'posts_per_page' => -1,
        'orderby' => 'meta_value_num',
        'meta_key' => 'order_new',
        'order' => 'ASC',
        'meta_query' => [
            [
                'key' => 'display_menu',
                'value' => 'yes',
                'compare' => '=',
            ],
        ],
    ];

    $soft_new = get_terms($args_soft_new);
    $term_page = get_queried_object();
    $taxonomy_name = 'list-news';
    $terms = get_terms([
        'taxonomy' => 'list-news',
        'parent' => $term_page->term_id,
        'hide_empty' => false,
    ]);
    $object = get_queried_object();
    @endphp
    <div class="navbar-study">
        <section class="top-nav custom_nav">
            <div class="container fix-height">
                <input id="menu-toggle" type="checkbox" />
                <label class='menu-button-container' for="menu-toggle">
                    <div class='menu-button'></div>
                </label>
                <div class="menu-wrapper">
                    <ul class="menu menu-nav finel-nav" id="nav-business">
                        {{-- @foreach ($terms_news as $key => $value) --}}
                        @foreach ($soft_new as $key => $value)
                            @if ($key < 9)
                                <?php
                                $term_id = $value->term_id;
                                $taxonomy_name = 'list-news';
                                $termchildren = get_term_children($term_id, $taxonomy_name);
                                ?>
                                <li><a href="{{ get_term_link($value->term_id) }}"
                                        class="menu-sub-item">{{ $value->name }}
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
        </section>
    </div>

    <div class="news-page news-custom news-other-bg">
        <div class="banner-about fixheight" style="background-image: url('{!! pll_current_language('slug') === 'vi' ? get_option('news_banner_vi') : get_option('news_banner') !!}');">

        </div>
        <div class="wapper-nf-breadcrumb">
            <div class="container">
                <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
            </div>
        </div>
        @if ($terms)
            <div class="container">
                <div class="main-news">
                    <div class="list-posts-about">
                        <div class="featured-post">
                            <div class="wapper-title-new">
                                <h2 class="post-title"><a href="/list-news/{{ $term_page->slug }}">
                                        {!! $term_page->name !!} </a>
                                </h2>
                                <div class="nav-search">
                                    {{ get_search_form() }}
                                </div>
                            </div>
                            <div class="wapper-list-categories">
                                <ul class="list-categories">
                                    @foreach ($terms as $item)
                                        @if ($loop->index <= 4)
                                            <li><a href="/list-news/{{ $item->slug }}">{{ $item->name }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                                <div class="select-categories">
                                    <span class="text-select">{!! pll_current_language('slug') === 'vi' ? 'Thêm chuyên mục' : 'Add category' !!}<span class="cs-menu-toggle"><i
                                                class="fa fa-angle-down"></i></span></span>
                                    <ul class="dropdown-content-categories">
                                        @foreach ($terms as $item)

                                            @if ($loop->index > 4)
                                                <li>
                                                    <a href="/list-news/{{ $item->slug }}">{{ $item->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <div class="row nf-row">
                                <div class="nf-col col-xl-9 col-lg-12 col-md-12 col-12">
                                    <article {!! post_class($query->posts[0]->ID) !!}>
                                        @php
                                            $term = get_the_terms($query->posts[0]->ID, 'list-news');
                                            $term_link = get_term_link($term[0]->term_id, 'list-news');
                                            $ids_not_in = [];
                                            array_push($ids_not_in, $query->posts[0]->ID);
                                        @endphp
                                        <div class="row nf-row">
                                            <div class="nf-col col-xl-8 col-lg-8 col-md-12 col-12">
                                                <div class="wapper-image">
                                                    {!! get_the_post_thumbnail($query->posts[0]->ID, 'full') !!}
                                                </div>
                                            </div>
                                            <div class="nf-col col-xl-4 col-lg-4 col-md-12 col-12 background-detail-post">
                                                <div class="wapper-detail-post">
                                                    <h3 class="entry-title">
                                                        <a
                                                            href="{{ get_permalink($query->posts[0]->ID) }}">{{ nf_limit_words(get_the_title($query->posts[0]->ID), 16) }}</a>
                                                    </h3>
                                                    <p class="entry-description">
                                                        {{ nf_limit_words(get_the_excerpt($query->posts[0]->ID), 30) }}
                                                    </p>
                                                    <a href="/list-news/{{ $term_page->slug }}" class="entry-author">
                                                        {{ $term_page->name }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="hr-small">
                                        <div class="row ">
                                            @php
                                                $i = 0;
                                            @endphp
                                            @if ($query->have_posts())
                                                @while ($query->have_posts())
                                                    {!! $query->the_post() !!}
                                                    @if ($i > 0 && $i < 4)
                                                        <div class=" col-xl-4 col-lg-6 col-md-12 col-12">
                                                            <article {!! post_class() !!}>
                                                                @php
                                                                    $term = get_the_terms(get_the_ID(), 'list-news');
                                                                    $term_link = get_term_link($term[0]->term_id, 'list-news');
                                                                    array_push($ids_not_in, get_the_ID());
                                                                @endphp
                                                                <div class="post-hot-item">
                                                                    <h3 class="post-title">
                                                                        <a
                                                                            href="{{ get_permalink() }}">{{ nf_limit_words(get_the_title(), 15) }}</a>
                                                                    </h3>
                                                                    <p class="post-description">
                                                                        {{ nf_limit_words(get_the_excerpt(), 30) }}
                                                                    </p>
                                                                    <a href="/list-news/{{ $term_page->slug }}"
                                                                        class="entry-author">
                                                                        {{ $term_page->name }}
                                                                    </a>
                                                                </div>
                                                            </article>
                                                        </div>
                                                    @endif
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endwhile
                                                {{ wp_reset_postdata() }}
                                            @endif


                                        </div>
                                    </article>
                                </div>
                                <div class="nf-col col-xl-3 col-lg-12 col-md-12 col-12">
                                    <div class="wapper-banner">
                                        @if (get_field('select_banner', $object) == 'image')
                                            <a href="{{ get_field('link_image_banner', $object) }}"><img
                                                    src="{{ get_field('image_banner', $object) }}"></a>
                                        @elseif (get_field('select_banner', $object) == 'video')
                                            <iframe src="{{ get_field('video_banner', $object) }}">
                                            </iframe>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <div class="wapper-list-new">
                                <div class="row nf-row">
                                    <div class="nf-col col-xl-8 col-lg-12 col-md-12 col-12 order-custom">
                                        <div class="wapper-list-right">
                                            @foreach ($terms as $item)
                                                @php
                                                    $term_link = get_term_link($item->term_id, 'list-news');
                                                    $args = [
                                                        'post_type' => 'news',
                                                        'post_status' => 'publish',
                                                        'order' => 'DESC',
                                                        'orderby' => 'date',
                                                        'ignore_sticky_posts' => true,
                                                        'posts_per_page' => 3,
                                                        'paged' => false,
                                                        'post__not_in' => $ids_not_in,
                                                        'tax_query' => [
                                                            [
                                                                'taxonomy' => 'list-news',
                                                                'field' => 'slug',
                                                                'terms' => [$item->slug],
                                                            ],
                                                        ],
                                                    ];
                                                    $term_posts = new \WP_Query($args);
                                                    $i = 0;
                                                    $j = 0;
                                                @endphp
                                                @if ($term_posts->have_posts())
                                                    <div class="item-new-right">
                                                        <ul>
                                                            <li><a
                                                                    href="/list-news/{{ $item->slug }}">{{ $item->name }}</a>
                                                            </li>
                                                        </ul>
                                                        <div class="row nf-row">

                                                            <div class="nf-col col-xl-7 col-lg-7 col-md-12 col-12">

                                                                @while ($term_posts->have_posts())

                                                                    {!! $term_posts->the_post() !!}
                                                                    @if ($i == 0)
                                                                        @php
                                                                            array_push($ids_not_in, get_the_ID());
                                                                        @endphp
                                                                        <div class="new-item">
                                                                            <a
                                                                                href="{{ esc_url(get_permalink(get_the_ID())) }}">
                                                                                {!! get_the_post_thumbnail(get_the_ID()) !!}
                                                                            </a>
                                                                            <h3 class="new-item-title">
                                                                                <a
                                                                                    href="{{ esc_url(get_permalink(get_the_ID())) }}">{{ nf_limit_words(get_the_title(), 15) }}</a>
                                                                            </h3>
                                                                            <p class="new-item-description">
                                                                                {{ nf_limit_words(get_the_excerpt(), 20) }}

                                                                            </p>
                                                                            <div class="spacer"></div>
                                                                        </div>
                                                                    @endif
                                                                    @php ++$i; @endphp
                                                                @endwhile
                                                                {{ wp_reset_postdata() }}
                                                            </div>
                                                            <div class="nf-col col-xl-5 col-lg-5 col-md-12 col-12">
                                                                <div class="list-item-new-right">
                                                                    @while ($term_posts->have_posts())
                                                                        {!! $term_posts->the_post() !!}
                                                                        @if ($j > 0)
                                                                            @php
                                                                                array_push($ids_not_in, get_the_ID());
                                                                            @endphp
                                                                            <h3><a
                                                                                    href="{{ esc_url(get_permalink(get_the_ID())) }}">{{ get_the_title() }}</a>
                                                                            </h3>
                                                                        @endif
                                                                        @php ++$j; @endphp
                                                                    @endwhile
                                                                    {{ wp_reset_postdata() }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="nf-col col-xl-4 col-lg-12 col-md-12 col-12">
                                        <div class="wapper-list-left">
                                            <div class="row nf-row">
                                                @php
                                                    $posts_view = new WP_Query([
                                                        'post_type' => 'news',
                                                        'post_status' => 'publish',
                                                        'order' => 'DESC',
                                                        'orderby' => 'date',
                                                        'ignore_sticky_posts' => true,
                                                        'posts_per_page' => 14,
                                                        'paged' => false,
                                                        'taxonomy' => 'list-news',
                                                        'post__not_in' => $ids_not_in,
                                                        'tax_query' => [
                                                            [
                                                                'taxonomy' => $taxonomy_name,
                                                                'field' => 'term_id',
                                                                'terms' => $term_page->term_id,
                                                            ],
                                                        ],
                                                    ]);
                                                    
                                                @endphp
                                                @while ($posts_view->have_posts())
                                                    {!! $posts_view->the_post() !!}
                                                    <div class="nf-col col-xl-12 col-lg-6 col-md-12 col-12">
                                                        <div class="list-new-left">
                                                            <div class="new-item">
                                                                <h3 class="new-item-title">
                                                                    <a
                                                                        href="{{ get_permalink() }}">{{ nf_limit_words(get_the_title(), 15) }}</a>
                                                                </h3>
                                                                <a href="{{ get_permalink() }}">
                                                                    <img src="{{ get_the_post_thumbnail_url() }}" alt=""
                                                                        class="new-item-image">
                                                                </a>
                                                                <p class="new-item-description">
                                                                    {{ nf_limit_words(get_the_excerpt(), 20) }}
                                                                </p>
                                                                <div class="spacer"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endWhile
                                                {{ wp_reset_postdata() }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wapper-banner-mobi">
                        @if (get_field('select_banner', $object) == 'image')
                            <a href="{{ get_field('link_image_banner', $object) }}"><img
                                    src="{{ get_field('image_banner', $object) }}"></a>
                        @elseif (get_field('select_banner', $object) == 'video')
                            <iframe src="{{ get_field('video_banner', $object) }}">
                            </iframe>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="container toppic-page">
                @php
                    $parent_term = get_term($term_page->parent, $taxonomy_name);
                    $terms_list = get_terms([
                        'taxonomy' => 'list-news',
                        'hide_empty' => true,
                        'parent' => $parent_term->term_id,
                    ]);
                @endphp
                <div class="wapper-title-new">
                    <h2 class="post-title"><a href="/list-news/{{ $parent_term->slug }}"> {!! $parent_term->name !!} </a>
                    </h2>
                    <div class="nav-search">
                        {{ get_search_form() }}
                    </div>
                </div>
                <div class="wapper-list-categories">
                    <ul class="list-categories">
                        @foreach ($terms_list as $item)
                            @if ($loop->index <= 4)
                                <li><a href="/list-news/{{ $item->slug }}">{{ $item->name }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="select-categories">
                        <span class="text-select">{!! pll_current_language('slug') === 'vi' ? 'Thêm chuyên mục' : 'Add category' !!}<span class="cs-menu-toggle"><i
                                    class="fa fa-angle-down"></i></span></span>
                        <ul class="dropdown-content-categories">
                            @foreach ($terms_list as $item)
                                @if ($loop->index > 4)
                                    <li>
                                        <a href="/list-news/{{ $item->slug }}">{{ $item->name }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row nf-row">
                    <div class="nf-col col-xl-9 col-lg-12 col-md-12 col-12">
                        <article {!! post_class($query_topic->posts[0]->ID) !!}>
                            @php
                                $term = get_the_terms($query_topic->posts[0]->ID, 'list-news');
                                $term_link = get_term_link($term[0]->term_id, 'list-news');
                            @endphp
                            <div class="row nf-row">
                                <div class="nf-col col-xl-8 col-lg-8 col-md-12 col-12">
                                    <div class="wapper-image">
                                        {!! get_the_post_thumbnail($query_topic->posts[0]->ID, 'full') !!}
                                    </div>

                                </div>
                                <div class="nf-col col-xl-4 col-lg-4 col-md-12 col-12 background-detail-post">
                                    <div class="wapper-detail-post">
                                        <h3 class="entry-title">
                                            <a
                                                href="{{ get_permalink($query_topic->posts[0]->ID) }}">{{ nf_limit_words(get_the_title($query_topic->posts[0]->ID), 16) }}</a>
                                        </h3>
                                        <p class="entry-description">
                                            {{ nf_limit_words(get_the_excerpt($query_topic->posts[0]->ID), 30) }}
                                        </p>
                                        <a href="{{ $term_link }}" class="entry-author">
                                            {{ $term[0]->name }}
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </article>
                        <div class="row">
                            <div class="col-12">
                                <div class="university-area list-post-news">
                                    <div class="list-posts-about">
                                        <div class="row">
                                            @php
                                                $i = 0;
                                            @endphp
                                            @if ($query_topic->have_posts())
                                                @while ($query_topic->have_posts())
                                                    {!! $query_topic->the_post() !!}
                                                    @if ($i > 0)
                                                        <div class="col-12">
                                                            <div class="single-post-about">
                                                                <div class="content-posts-about">
                                                                    <h4><a href="{{ get_the_permalink() }}">
                                                                            {{ get_the_title() }}</a></h4>
                                                                    <div class="descrip-abouts">
                                                                        {{ wp_trim_words(get_the_content(), $num_words = 20) }}
                                                                    </div>
                                                                </div>
                                                                <a href="{{ get_the_permalink() }}">
                                                                    <div class="img-posts-about single-post-about"
                                                                        style="background-image: url('{{ get_the_post_thumbnail_url() }}');">
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endwhile
                                                {{ wp_reset_postdata() }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nf-col col-xl-3 col-lg-12 col-md-12 col-12">
                        <div class="wapper-banner">
                            @if (get_field('select_banner', $object) == 'image')
                                <a href="{{ get_field('link_image_banner', $object) }}"><img
                                        src="{{ get_field('image_banner', $object) }}"></a>
                            @elseif (get_field('select_banner', $object) == 'video')
                                <iframe src="{{ get_field('video_banner', $object) }}">
                                </iframe>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="wapper-banner-mobi">
                    @if (get_field('select_banner', $object) == 'image')
                        <a href="{{ get_field('link_image_banner', $object) }}"><img
                                src="{{ get_field('image_banner', $object) }}"></a>
                    @elseif (get_field('select_banner', $object) == 'video')
                        <iframe src="{{ get_field('video_banner', $object) }}">
                        </iframe>
                    @endif
                </div>
            </div>
        @endif
    </div>
    {{-- {{ dd($ids_not_in) }} --}}
@endsection
