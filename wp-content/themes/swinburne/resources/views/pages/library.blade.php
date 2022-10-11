@extends('layouts.app')
@section('content')
<div class="about-page">
    <div class="banner-about fixheight" style="background-image: url('{!! pll_current_language('slug')==='vi' ? get_option('banner_lybrary_vi') : get_option('banner_lybrary') !!}');">

    </div>
    <div class="about-us">
        <div class="container">
            <div class="main-about">
                <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                <hr>
                <h1>{!! $object_current ->post_title !!}</h1>
                {!! apply_filters('the_content',  $object_current ->post_content) !!}
               {{--  <div class="list-posts-about">
                    <div class="row">
                        @php
                        @endphp
                        @if ($query_library->have_posts())
                        @while ($query_library->have_posts())
                        @php
                        $query_library->the_post();
                        @endphp
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="single-post-about library-post">
                                @php
                                $get_field = get_field('link_to', get_the_ID());
                                @endphp
                                <a href="{{ $get_field === NULL || $get_field === '' ? get_permalink() : $get_field }}">
                                    <div class="img-posts-about" style="background-image: url('{{ get_the_post_thumbnail_url() }}');">

                                    </div>
                                </a>
                                <div class="content-posts-about">
                                    <h4><a href="{{ $get_field === NULL || $get_field === '' ? get_permalink() : $get_field }}">{{get_the_title()}}</a></h4>
                                    <div class="descrip-abouts">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endwhile
                        @endif
                    </div>
                    {!! do_action('vicoders_pagination', $paged, $total)!!}
                </div> --}}

                <div class="list-posts-about">
                    <div class="row">
                        @foreach ($soft_library as $library)
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="single-post-about library-post">
                                    @php
                                    $get_field = get_field('link_to', $library->ID);
                                    @endphp
                                    <a href="{{ $get_field === NULL || $get_field === '' ? get_permalink($library->ID) : $get_field }}">
                                        <div class="img-posts-about" style="background-image: url('{{ get_the_post_thumbnail_url($library->ID) }}');">

                                        </div>
                                    </a>
                                    <div class="content-posts-about">
                                        <h2><a href="{{ $get_field === NULL || $get_field === '' ? get_permalink($library->ID) : $get_field }}">{{get_the_title($library->ID)}}</a></h2>
                                        <div class="descrip-abouts">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {!! do_action('vicoders_pagination', $paged, $total)!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection