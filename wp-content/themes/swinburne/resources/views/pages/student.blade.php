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
                        @foreach ($soft_students as $key => $value)
                            @php
                                $get_field_student = get_field('link_to_student', $value->taxonomy . '_' . $value->term_id);
                            @endphp

                            @if ($key < 6)
                                <?php
                                $term_id = $value->term_id;
                                $taxonomy_name = 'list-student';
                                $termchildren = get_term_children($term_id, $taxonomy_name);
                                ?>
                                <li><a class="{{ $value->term_id == $_GET['term_id'] ? 'active' : ' ' }}"
                                        href="{{ $get_field_student === null || $get_field_student === '' ? get_term_link($value->term_id) : $get_field_student }}">{{ $value->name }}
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
    <div class="student-page">
        <div class="banner-about fixheight" style="background-image: url('{!! pll_current_language('slug') === 'vi' ? get_option('current_student_vi') : get_option('current_student') !!}');">

        </div>
        <div class="about-us">
            <div class="wapper-breadcrumb">
                <div class="container">
                    <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                </div>
            </div>

            <div class="container">
                <div class="main-about">


                    <h1>{!! $object_current->post_title !!}</h1>
                    <div class="description-page">
                        {!! apply_filters('the_content', $object_current->post_content) !!}
                    </div>

                    <hr>
                    <div class="list-posts-about">
                        <div class="row nf-row">
                            @foreach ($soft_students as $value)
                                @php
                                    if (function_exists('z_taxonomy_image_url')) {
                                        $img = z_taxonomy_image_url($value->term_id);
                                    } else {
                                        $img = '';
                                    }
                                @endphp
                                <div class="nf-col col-lg-6 col-xl-4">
                                    <div class="single-post-about">
                                        @php
                                            $get_field_student = get_field('link_to_student', $value->taxonomy . '_' . $value->term_id);
                                        @endphp
                                        <a
                                            href="{{ $get_field_student === null || $get_field_student === '' ? get_term_link($value->term_id) : $get_field_student }}">
                                            <div class="img-posts-about"
                                                style="background-image: url('{{ $img }}');">
                                                <div class="content-posts-about">
                                                    <h2>{{ $value->name }}
                                                    </h2>
                                                    <div class="descrip-abouts">
                                                        {!! nf_limit_words($value->description, 6) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
