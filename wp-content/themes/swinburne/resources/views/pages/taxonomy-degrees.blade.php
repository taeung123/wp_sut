@extends('layouts.app')
@section('content')
<div class="about-page">
    <div class="banner-about fixheight" style="background-image: url('{{ get_option('double_degrees')}}');">

    </div>
    <div class="about-us">
        <div class="container">
            <div class="main-about">
                <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                <hr>
                <h1>{{get_the_title()}}</h1>
                <p>
                    <?php echo term_description($_GET['term_id'], 'list-about') ?>
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
                                    <h2><a href="{{ get_the_permalink() }}">{{get_the_title()}}</a></h2>
                                    <div class="descrip-abouts">
                                        <p>{{ get_the_content() }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endwhile
                        @endif
                    </div>
                    {!! do_action('degrees_pagination_global') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection