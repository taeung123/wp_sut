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
                    <ul class="menu menu-nav finel-nav only-tintuc" id="nav-business">
                        @foreach ($terms_tintuc as $key => $value)
                            @if ($key < 7)
                                <li><a class="{{ $value->term_id == $_GET['term_id'] ? 'active' : ' ' }}"
                                        href="{{ get_term_link($value->term_id) }}">{{ $value->name }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </div>
    <div class="about-page">
        <div class="banner-about fixheight" style="background-image: url('{{ get_option('tintuc_banner') }}');">

        </div>
        <div class="about-us">
            <div class="container">
                <div class="main-about">
                    <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                    <hr>
                    <h1>{!! get_term_by('id', get_queried_object()->term_id, 'list-tintuc')->name !!}</h1>


                    {!! apply_filters('the_content', get_term_by('id', get_queried_object()->term_id, 'list-tintuc')->description) !!}

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
                                                <div class="img-posts-about"
                                                    style="background-image: url('{{ get_the_post_thumbnail_url() }}');">

                                                </div>
                                            </a>
                                            <div class="content-posts-about">
                                                <h2><a href="{{ get_the_permalink() }}">{{ get_the_title() }}</a></h2>
                                                <div class="descrip-abouts">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endwhile
                            @endif
                        </div>
                        {{ do_action('tintuc_page_pagination_global') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
