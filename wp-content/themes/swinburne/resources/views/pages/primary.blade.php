@extends('layouts.app')
@section('content')
<div class="about-page primary-page">
    <div class="banner-about fixheight" style="background-image: url('{{ get_the_post_thumbnail_url($object_current->ID,'full')}}');">

    </div>
    <div class="about-us">
        <div class="container">
            <div class="main-about main-research">
                <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                <hr>
                <h1>{!! $object_current->post_title !!}</h1>
                <div>

                     {!! apply_filters('the_content', $object_current ->post_content) !!}
                </div>

            </div>
        </div>
    </div>

</div>
@endsection