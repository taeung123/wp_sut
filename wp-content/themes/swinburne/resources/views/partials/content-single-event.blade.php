<div class="about-page event-detail-page">
    <div class="about-us">
        <div class="container">
            <div class="main-about main-event-detail">
                <div class="nf-breadcrumb">{{ nf_get_bread_crumb() }}</div>
                <hr>
                <h1>
                    {{ get_the_title()}}
                </h1>

                <div class="event-content">
                    {!! the_content() !!}
                </div>

                <hr>
                <h2> {!! pll_current_language('slug')==='vi' ? 'Thêm sự kiện' : 'More Events'!!}</h2>
                <div class="list-posts-about">
                    <div class="row">
                        @php
                        @endphp
                        @if ($query_event->have_posts())
                        @while ($query_event->have_posts())
                        @php
                        $query_event->the_post();
                        @endphp
                        <div class="col-lg-4">
                                    <div class="single-post-about">
                                        <a href="{!! get_the_permalink()!!}"><div class="img-posts-about list-post-news" style="background-image: url('{{ get_the_post_thumbnail_url() }}');">
                                        </div></a>
                                        <div class="content-posts-about">
                                            <h4><a href="{!! get_the_permalink()!!}">{{ get_the_title()}}</a></h4>
                                            <div class="descrip-abouts">
                                                 {!! apply_filters('the_content', get_field('custom_descript_single_post')) !!}
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