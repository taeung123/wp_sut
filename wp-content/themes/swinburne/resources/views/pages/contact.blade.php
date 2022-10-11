@extends('layouts.app')
@section('content')
<div class="banner-study fixheight" style="background-image: url('{!! pll_current_language('slug')==='vi' ? get_option('banner_contact_vi') : get_option('banner_contact') !!}');">

</div>
<div class="about-detail course-study contact-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="personal-info">
                    <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                    <hr>
                    <h1>{!! $object_current->post_title!!}</h1>
                    <p>{!! $object_current->post_content!!}</p>
                     {!! do_shortcode("[nf_contact_form name='Contact-info']")!!}
                </div>
            </div>
            <div class="col-lg-3">
                <ul class="enquiry-apply apply-contact">
                   <li class="red-bg"><a class="no_hover"> {!! pll_current_language('slug')==='vi' ? 'LIÊN HỆ VỚI CHÚNG TÔI' : 'CONTACT US TODAY!'!!}</a></li>

                    <li><a href="{{ get_option('visit_us')}}"><i class="fa fa-map-marker" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? get_option('visit_us_label_vi') : get_option('visit_us_label') !!}</a></li>

                    <li><a href="tel:{{ get_option('Phone_call')}}"><i class="fa fa-phone" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? 'GỌI NGAY' : 'CALL US ON '!!}
                    {{ get_option('Phone_call')}}</a></li>
                     <li><a href="tel:{{ get_option('hotline')}}"><i class="fa fa-phone" aria-hidden="true"></i>{!! pll_current_language('slug')==='vi' ? 'HOTLINE' : 'HOTLINE'!!}
                                {{ get_option('hotline')}}</a></li>

                    <li><a href="{{ get_option('swinburne_href')}}"><i class="fa fa-facebook" aria-hidden="true"></i>@Swinburne</a></li>
                </ul>
                <div class="map-iframe">
                    <iframe src="{{ get_option('map_location')}}" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <div class="map-go-to">
                        <a href="{{ get_option('map_direction')}}"> {!! pll_current_language('slug')==='vi' ? 'Xem bản đồ' : 'Map directions'!!}<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection