@extends('layouts.app')
@section('content')
<div class="about-page">
    <div class="banner-about fixheight" style="background-image: url('{{ get_option('banner_contact')}}');">

    </div>
    <div class="about-us">
        <div class="container">
            <div class="thanks-page">
               <div class="box-thanks">
                    <div class="logo-thanks">
                    <a href=""><img src="{{ get_stylesheet_directory_uri() }}/resources/assets/images/contact/thanks_logo.png" alt="hr"></a>
                </div>
                <div class="main-text">
                    <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                    <h1>{{ get_field('tieu_de_cam_on')}}</h1>
                    <p>{{ get_field('van_bản_1')}}</p>
                    <div class="thanks-txt">
                        <p>{{ get_field('van_bản_2')}}</p>
                        <span>"{{ get_field('text_trich_dan')}}"</span>
                        <a href="{!! pll_current_language('slug')==='en' ? site_url('/en') : site_url('') !!}" class="link-thanks"> {!! pll_current_language('slug')==='vi' ? 'Quay lại Trang Chủ' : 'Return home'!!}</a>
                    </div>
                </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection