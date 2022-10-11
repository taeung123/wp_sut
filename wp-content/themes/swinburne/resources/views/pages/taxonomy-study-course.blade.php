@extends('layouts.app')
@section('content')
@include('pages/navbar-study')
<div class="banner-study">
    <img src="{{ get_stylesheet_directory_uri() }}/resources/assets/images/study-us/bg-major.png" alt="hr">
</div>
<div class="about-detail course-study course-major">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="main-content-detail main-content-course main-content-major">
                    <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                    <h1>Research partnerships</h1>
                    <div class="detail-cont-descript">
                        <p>Swinburne is a large and culturally diverse organisation. A desire to innovate and bring about positive change motivates our students and staff. The result is in an institution that grows and evolves each year. </p>
                        <p>The story of our company began in 2000, when we opened our first factory with own production under the ARMATURY Group brand at Dolní Benešov. We have just extended the long tradition and history of production of industrial valves in the Opava and Hlučín Region beginning in the middle of the last century. Thanks to the merger of three companies operating in the Czech Republic and Slovakia in the field of production, sales and servicing of</p>
                    </div>
                    <div class="majors-tab">
                        <h2>Toggleable Tabs</h2>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs one-by-one" role="tablist">
                            <li class="item-major">
                                <a class=" active" data-toggle="tab" href="#majo1">Digital Media Design</a>
                                <a class="" data-toggle="tab" href="#majo2">Branded Environments</a>
                                <a class="" data-toggle="tab" href="#majo3">UI/UX Design</a>
                            </li>
                            <li class="item-major">
                                <a class="" data-toggle="tab" href="#majo4">Photography</a>
                                <a class="" data-toggle="tab" href="#majo5">Visual Arts</a>
                                <a class="" data-toggle="tab" href="#majo6">Digital Media Design</a>
                            </li>
                            <li class="item-major">
                                <a class="" data-toggle="tab" href="#majo7">Industrial and Product Design</a>
                                <a class="" data-toggle="tab" href="#majo8">Digital Media Design</a>
                                <a class="" data-toggle="tab" href="#majo9">Digital Media Design</a>
                            </li>
                            <li class="item-major">
                                <a class="" data-toggle="tab" href="#majo10">Branded Environments</a>
                                <a class="" data-toggle="tab" href="#majo11">UI/UX Design</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                    </div>
                    <div class="course-info">
                        <h3>Course Info </h3>
                        <p class="click_advance1"> Designs<i class="fa fa-plus"></i></p>
                        <div class="display_advance1">
                            <ul class="ranking">
                                <li>Allied Health Design</li>
                                <li>Service Design</li>
                                <li>Product Manufacturing Design</li>
                                <li>Public Good Design</li>
                            </ul>
                            <ol class="list-ol">
                                <li><a href="">Centre for Design Innovation <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                <li><a href="">Department of Communication Design and Digital Media Design<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                <li><a href="">Department of Interior Architecture and Industrial Design<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                            </ol>
                        </div>
                        <p class="click_advance2"> Systems Analysis<i class="fa fa-plus"></i></p>
                        <div class="display_advance2">
                            <ul class="ranking">
                                <li>Allied Health Design</li>
                                <li>Service Design</li>
                                <li>Product Manufacturing Design</li>
                                <li>Public Good Design</li>
                            </ul>
                        </div>
                    </div>
                    <div class="student-work">
                        <h3>Student Work</h3>
                        <div class="slider-student">
                            <div> <img src="{{ get_stylesheet_directory_uri() }}/resources/assets/images/study-us/slider-student.png" alt="hr"></div>
                            <div> <img src="{{ get_stylesheet_directory_uri() }}/resources/assets/images/study-us/slider-student.png" alt="hr"></div>
                            <div> <img src="{{ get_stylesheet_directory_uri() }}/resources/assets/images/study-us/slider-student.png" alt="hr"></div>
                            <div> <img src="{{ get_stylesheet_directory_uri() }}/resources/assets/images/study-us/slider-student.png" alt="hr"></div>
                            <div> <img src="{{ get_stylesheet_directory_uri() }}/resources/assets/images/study-us/slider-student.png" alt="hr"></div>
                        </div>
                    </div>
                    <div class="how-to">
                        <h3>How to apply</h3>
                        <div class="start-discover">
                            <div class="icon-apply">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <span>View the Course Admission Information, which includes the ATAR and Student profiles for this course. Swinburne’s general admissions information is also available here.
                                </span>
                            </div>
                            <div class="target-link">
                                <a href="">discover</a>
                            </div>
                        </div>
                        <ol class="list-ol display-none">
                            <li class="no-border"><a href="">Email us <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                            <li><a href="">Schedule a one-on-one<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                            <li class="call-last"><a>Call us<i class="fa fa-angle-down" aria-hidden="true"></i></a></li>
                        </ol>
                        <p class="para-show">Local student: 099877666</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <ul class="enquiry-apply enquiry-pd">
                    <li><a href=""><i class="fa fa-paper-plane" aria-hidden="true"></i>ENQUIRY & APPLY NOW</a></li>
                    <li><a href=""><i class="fa fa-download" aria-hidden="true"></i></i>DOWNLOAD A COURSE GUIDE</a></li>
                    <li><a href=""><i class="fa fa-file-code-o" aria-hidden="true"></i>BOOK A ONE- ON-ONE</a></li>
                </ul>
                <ul class="enquiry-apply">
                    <li><a href="">CONTACT US TODAY!</a></li>
                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>VISIT US</a></li>
                    <li><a href=""><i class="fa fa-phone" aria-hidden="true"></i></i>CALL US ON + 613 9214 8000</a></li>
                    <li><a href=""><i class="fa fa-paper-plane" aria-hidden="true"></i>EMAIL</li></a>
                    <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i>@Swinburne</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection