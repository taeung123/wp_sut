
@extends('layouts.app')
@section('content')

<div class="about-page research-custom">
    <div class="banner-about fixheight" style="background-image: url('{!! pll_current_language('slug')==='vi' ? get_option('banner_lybrary_vi') : get_option('banner_lybrary') !!}');">

    </div>
    <div class="about-us">
        <div class="container">
            <div class="main-about main-research">
                <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                <hr>
                <h1>{!! $object_current ->post_title !!}</h1>
                {!! apply_filters('the_content',  $object_current ->post_content) !!}
                <div class="list-posts-about">
                    <div class="row">
                        @foreach($terms_refer as $value)
                        @php
                        if (function_exists('z_taxonomy_image_url')) {
                        $img_refer = z_taxonomy_image_url($value->term_id);
                        } else {
                        $img_refer = '';
                        }
                        @endphp
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-post-about">
                                <a href="{{ get_term_link($value->term_id) }}">
                                    <div class="img-posts-about" style="background-image: url('{{ $img_refer }}');">

                                    </div>
                                </a>
                                <div class="content-posts-about">
                                    <h2><a href="{{ get_term_link($value->term_id) }}">{{ $value->name }}</a></h2>
                                    <div class="descrip-abouts">
                                         {{wp_trim_words($value->description, $num_words = 20)}}
                                    </div>
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
@endsection