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
<div class="about-page">
    <div class="banner-about fixheight" style="background-image: url('{!! pll_current_language('slug')==='vi' ? get_option('graduate_study_vi') : get_option('graduate_study') !!}');">

    </div>
    <div class="about-us">
        <div class="container">
            <div class="main-about">
                <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                <hr>
                <h1>{{ $object_current ->post_title }}</h1>
                {!! $object_current ->post_content !!}
                <div class="list-posts-about">
                    <div class="row">
                        @php
                        @endphp
                        @if ($query_graduate_post->have_posts())
                        @while ($query_graduate_post->have_posts())
                        @php
                        $query_graduate_post->the_post();
                        @endphp
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="single-post-about">
                                <a href="{{ get_the_permalink() }}">
                                    <div class="img-posts-about" style="background-image: url('{{ get_the_post_thumbnail_url() }}');">

                                    </div>
                                </a>
                                <div class="content-posts-about">
                                    <h2><a href="{{ get_the_permalink() }}">{{get_the_title()}}</a></h2>
                                    <div class="descrip-abouts">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endwhile
                        @endif
                    </div>
                    {!! do_action('vicoders_pagination', $paged, $total)!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection