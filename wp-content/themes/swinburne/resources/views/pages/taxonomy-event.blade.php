@extends('layouts.app')
@section('content')
<div class="banner-event fixheight" style="background-image: url('{{ get_option("banner_event")}}');">

</div>
<div class="event-page">
    <div class="container">
        <div class="main-event-page">
            <div class="row">
                <div class="col-lg-3">
                    <div class="calendar-filter">
                        <div class="calendar-event">
                            <div class="calendar">
                                <div class="group calendar-ympicker">
                                    <div class="calendar-ympicker-header">
                                        <div style="font-size:small;" class="today"> {!! pll_current_language('slug')==='vi' ? 'Hôm nay' : 'Today'!!}</div>
                                        <div style="float:right;width:20%;text-align:right;" class="close">&uarr;</div>
                                    </div>
                                    <ul style="clear:both;" class="center calendar-ympicker-months">
                                        <li>Jan</li>
                                        <li>Feb</li>
                                        <li>Mar</li>
                                        <li>Apr</li>
                                        <li>May</li>
                                        <li>Jun</li>
                                        <li>Jul</li>
                                        <li>Aug</li>
                                        <li>Oct</li>
                                        <li>Sep</li>
                                        <li>Nov</li>
                                        <li>Dec</li>
                                    </ul>
                                    <ul class="center calendar-ympicker-years">
                                    </ul>
                                </div>
                                <div class="group calendar-header">
                                    <p class="pointer center monthname">&nbsp;</p>
                                    <p class="pointer arrow minusmonth"><span>&larr;</span></p>
                                    <p class="pointer arrow addmonth"><span>&rarr;</span></p>
                                </div>
                                <ul class="group calendar-days">
                                    <li>Mo</li>
                                    <li>Tu</li>
                                    <li>We</li>
                                    <li>Th</li>
                                    <li>Fr</li>
                                    <li>Sa</li>
                                    <li>Su</li>
                                </ul>
                                <ul class="group calendar-body calendar_body">
                                    <!-- Dates go in here -->
                                </ul>
                                <div class="group calendar-header calendar-footer">
                                    <p class="pointer center monthname">&nbsp;</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filter-by-category">
                       <h4> {!! pll_current_language('slug')==='vi' ? 'Lọc theo danh mục' : 'Filter by category'!!}</h4>
                        <ul class="list-filter">
                            @foreach ($terms as $value)
                            <li><a class="{{ $value->term_id == $_GET['term_id'] ? 'active' : ' ' }}" href="{{ get_term_link($value->term_id) }}">{{ $value->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="event-study">
                        <div class="event-title">
                            <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                            <hr>
                            <div class="event-link">
                                <h1>{{get_the_title()}}</h1>
                                <div class="go-to">
                                    {{ get_search_form() }}
                                </div>
                            </div>
                            <div class="row">
                                 @php
                                @endphp
                                @if ($hight->have_posts())
                                @while ($hight->have_posts())
                                @php
                                $hight->the_post();
                                @endphp
                                <div class="col-lg-12">
                                    <div class="big-picture">
                                        <div class="month-day monday-event">
                                            <p class="have-border">04<br>MAY</p>
                                            <span></span>
                                            <p>07<br>MAY</p>
                                        </div>
                                        <a href="{{ get_the_permalink() }}">
                                            <div class="picture-img have-height" style="background-image: url('{{ get_the_post_thumbnail_url() }}');">

                                            </div>
                                        </a>
                                        <div class="tex-event-course">
                                            <h2><a href="">{{ get_the_title()}} </a></h2>
                                            <div class="go-to-link">
                                                <a href="{{ get_the_permalink() }}"> {!! pll_current_language('slug')==='vi' ? 'khám phá' : 'discover'!!}<i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  @endwhile
                                @endif

                                @php
                                @endphp
                                @if ($query->have_posts())
                                @while ($query->have_posts())
                                @php
                                $query->the_post();
                                @endphp
                                <div class="col-lg-4">
                                    <div class="big-picture">
                                        <div class="month-day">
                                            <p>04<br>MAY</p>
                                        </div>
                                        <a href="{{ get_the_permalink() }}">
                                            <div class="picture-img big-pic-bg" style="background-image: url('{{ get_the_post_thumbnail_url() }}');">

                                            </div>
                                        </a>
                                        <div class="tex-event-course">
                                            <h2><a href="{{ get_the_permalink() }}">{{get_the_title()}}</a></h2>
                                            <div class="go-to-link">
                                                <a href="">discover<i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endwhile
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection