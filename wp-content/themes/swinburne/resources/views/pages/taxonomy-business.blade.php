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
                <ul class="menu menu-nav finel-nav only-business" id="nav-business">
                    @foreach ($terms_business as $key => $value)
                    @if ($key < 5) <li><a class="{{ $value->term_id == $_GET['term_id'] ? 'active' : ' ' }}" href="{{ get_term_link($value->term_id) }}">{{ $value->name }}</a></li>
                        @endif
                        @endforeach
                </ul>
            </div>
        </div>
    </section>
</div>
<div class="about-page business-page">
    <div class="banner-about fixheight" style="background-image: url('{{ $value_banner }}');">

    </div>
    <div class="about-us business">
        <div class="container">
            <div class="main-about main-business">
                <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                <hr>
                <h1>{!! get_term_by( "id", get_queried_object()->term_id, 'list-business')->name !!}</h1>
                <p>
                    {!! get_term_by( "id", get_queried_object()->term_id, 'list-business')->description !!}
                </p>
                <div class="list-posts-about">
                    <div class="row">
                        @php
                        @endphp
                        @if ($query->have_posts())
                        @while ($query->have_posts())
                        @php
                        $query->the_post();
                        @endphp
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="single-post-about">
                                <a href="{{ get_the_permalink() }}">
                                    <div class="img-posts-about" style="background-image: url('{{ get_the_post_thumbnail_url() }}');">

                                    </div>
                                </a>
                                <div class="content-posts-about">
                                    <h3><a href="{{ get_the_permalink() }}">{{get_the_title()}}</a></h3>
                                    <div class="descrip-abouts">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endwhile
                        @endif
                    </div>
                    {!! do_action('business_page_pagination_global') !!}
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
        </div>
    </div>
</div>
@endsection