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
                        @foreach ($terms_about as $key => $value)
                            @if ($key < 5)
                                <?php
                                $term_id = $value->term_id;
                                $taxonomy_name = 'list-about';
                                $termchildren = get_term_children($term_id, $taxonomy_name);
                                ?>
                                <li><a class="{{ $value->term_id == $_GET['term_id'] ? 'active' : ' ' }}"
                                        href="{{ get_term_link($value->term_id) }}">{{ $value->name }}
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
    <div class="about-page">
        <div class="banner-about fixheight" style="background-image: url('{{ get_option('banner_about') }}');">

        </div>
        <div class="about-us">
            <div class="container">
                <div class="main-about">
                    <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                    <hr>
                    <h2>{!! get_term_by('id', get_queried_object()->term_id, 'list-about')->name !!}</h2>
                    {!! get_field('description_tax', $term->taxonomy . '_' . $term->term_id) !!}
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
                        {!! do_action('namtin_pagination_global') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
