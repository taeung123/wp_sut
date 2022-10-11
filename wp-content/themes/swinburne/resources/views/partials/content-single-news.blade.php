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
            'key' => 'order_new',
            'type' => 'numeric',
            'value' => 1,
            'compare' => '>=',
        ],
    ],
];

$soft_new = get_terms($args_soft_new);
$term_page = get_queried_object();
$taxonomy_name = 'list-news';
$terms = get_term_children($term_page->term_id, $taxonomy_name);

$terms_list = get_terms([
    'taxonomy' => 'list-news',
    'hide_empty' => true,
    'meta_query' => [
        [
            'key' => 'show_news',
            'value' => 'yes',
            'compare' => '=',
        ],
    ],
]);

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
<div class="banner-about fixheight" style="background-image: url('{!! pll_current_language('slug') === 'vi' ? get_option('news_banner_vi') : get_option('news_banner') !!}');"></div>
<div class="detail-new-page news-page news-other-bg">
    <div class="container">
        <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
        <div class="wapper-title-new">
            <h2 class="post-title">{!! pll_current_language('slug') === 'vi' ? 'Tin tức' : 'News' !!}</h2>
            <div class="nav-search">
                {{ get_search_form() }}
            </div>
        </div>
        <div class="wapper-list-categories">
            <ul class="list-categories">
                @foreach ($terms_list as $item)
                    @if ($loop->index <= 3)
                        <li><a href="/list-news/{{ $item->slug }}">{{ $item->name }}</a></li>
                    @endif
                @endforeach
            </ul>
            <div class="select-categories">
                <span class="text-select">{!! pll_current_language('slug') === 'vi' ? 'Thêm chuyên mục' : 'Add category' !!} <span class="cs-menu-toggle"><i
                            class="fa fa-angle-down"></i></span></span>
                <ul class="dropdown-content-categories">
                    @foreach ($terms_list as $item)
                        @if ($loop->index > 3)
                            <li>
                                <a href="/list-news/{{ $item->slug }}">{{ $item->name }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-lg-9">
                <div class="main-content-detail main-news">
                    <h1>
                        {{ get_the_title() }}
                    </h1>

                    {!! the_content() !!}
                    <p class="author-name">{{ get_the_author() }} </p>
                    <div class="share-news">
                        <iframe
                            src="https://www.facebook.com/plugins/like.php?href={{ get_the_permalink() }}%2F&width=450&layout=standard&action=like&size=small&share=true&height=35&appId=<?php echo get_option('id_app_fb'); ?>"
                            width="100%" height="35" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                            allowTransparency="true" allow="encrypted-media">
                        </iframe>
                    </div>
                    @include('partials.comments')
                    <hr>

                    <div class="university-area list-post-news">
                        <div class="list-posts-about">
                            <div class="row">
                                @php
                                @endphp
                                @if ($query_news->have_posts())
                                    @while ($query_news->have_posts())
                                        @php
                                            $query_news->the_post();
                                        @endphp
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
                                    @endwhile
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="sidebar sidebar-news">

                    @php
                        $object = get_queried_object();
                    @endphp
                    <div class="wapper-banner">
                        @if (get_field('select_banner', $object) == 'image')
                            <a href="{{ get_field('link_image_banner', $object) }}"><img
                                    src="{{ get_field('image_banner', $object) }}"></a>
                        @elseif (get_field('select_banner', $object) == 'video')
                            <iframe src="{{ get_field('video_banner', $object) }}">
                            </iframe>
                        @endif
                    </div>
                    <hr class="hr-small">
                    <div class="news-sidebar">
                        <div class="sideba-title">
                            <h3>{!! pll_current_language('slug') === 'vi' ? 'Tin nổi bật' : 'Hot news' !!}</h3>
                        </div>
                        @php
                            $i = 0;
                            $j++;
                        @endphp
                        @if ($query_news->have_posts())
                            @while ($query_news->have_posts())
                                @php
                                    $query_news->the_post();
                                @endphp
                                @if ($i == 0)
                                    <div class="single-sidebar">
                                        <div class="sidebar-img">
                                            <a href="{{ get_the_permalink() }}"> <img
                                                    src="{{ get_the_post_thumbnail_url() }}"
                                                    alt="{{ get_the_title() }}"></a>
                                        </div>
                                        <div class="sidebar-descript sidebar-news">
                                            <a href="{{ get_the_permalink() }}">
                                                {{ wp_trim_words(get_the_title(), $num_words = 20) }}</a>
                                            <p>{{ wp_trim_words(get_the_excerpt(), $num_words = 25) }}</p>
                                        </div>
                                    </div>

                                    @php
                                        $i++;
                                    @endphp
                                @endif
                            @endwhile
                        @endif
                        <div class="list-new-hot">
                            @if ($query_news->have_posts())
                                @while ($query_news->have_posts())
                                    @php
                                        $query_news->the_post();
                                    @endphp
                                    @if ($j > 1)
                                        <a href="{{ get_the_permalink() }}">
                                            {{ wp_trim_words(get_the_title(), $num_words = 20) }}</a>
                                    @endif
                                    @php
                                        $j++;
                                    @endphp
                                @endwhile
                            @endif
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
</div>
