@extends('layouts.app')
@section('content')
<div class="banner-study fixheight" style="background-image: url('{{ get_option('banner_contact')}}');">

</div>
<div class="about-detail course-study contact-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
              <div class="personal-info">
                  <h4>PERSONAL INFORMATION INFO</h4>
                  <p>Leave your information here to apply for scholarship!</p>
                  {!! do_shortcode("[nf_contact_form name='Contact-info']")!!}
              </div>
            </div>
            <div class="col-lg-3">
                <ul class="enquiry-apply apply-contact">
                    <li class="red-bg"><a href="{!! site_url('contact-us')!!}">CONTACT US TODAY!</a></li>
                        <li><a href="{{ get_option('visit_us')}}"><i class="fa fa-map-marker" aria-hidden="true"></i>VISIT US</a></li>
                        <li><a href="tel:{{ get_option('Phone_call')}}"><i class="fa fa-phone" aria-hidden="true"></i>CALL US ON {{ get_option('Phone_call')}}</a></li>
                        <li><a href="{{ get_option('swinburne_href')}}"><i class="fa fa-facebook" aria-hidden="true"></i>@Swinburne</a></li>
                </ul>
                <div class="map-iframe">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.4831097752717!2d105.8176563142451!3d21.01334709368177!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab7cfde17a0f%3A0xe7c176a980c08213!2zU-G7kSA0MiwgMTc4IFRow6FpIEjDoCwgVHJ1bmcgTGnhu4d0LCDEkOG7kW5nIMSQYSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1557702512787!5m2!1svi!2s" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <div class="map-go-to">
                        <a href="">Map directions<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection