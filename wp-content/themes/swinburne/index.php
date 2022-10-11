<?php

/**
 * Template Name: index Template
 *
 */

function getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count . ' Views';
}

$args = [
    'posts_per_page' => 6,
    'paged' => $paged,
];

$highlight = [
    'posts_per_page' => 2,
    'meta_key' => 'highlight',
    'meta_value' => 'yes',
    'post_type' => 'news',
];
$hight = new WP_Query($highlight);
$single = [
    'posts_per_page' => 1,

    'post_type' => 'event',
];
$single_post = new WP_Query($single);

$single_hight = [
    'posts_per_page' => 1,
    'orderby' => 'rand',
    'post_type' => 'event',
];
$single_post_event = new WP_Query($single_hight);

$query_news = new WP_Query($args);

////
$args_event = [
    'post_type' => 'event',
    'posts_per_page' => 5,
];
$query_event = new WP_Query($args_event);

$terms = get_terms(array(
    'taxonomy' => 'list-course',
    'hide_empty' => false,
));

$terms_student = get_terms(array(
    'taxonomy' => 'list-student',
    'hide_empty' => false,
));

$terms_research = get_terms(array(
    'taxonomy' => 'list-research',
    'hide_empty' => false,
));
// echo "<pre>";
// var_dump($terms_student);
// die();
// Get the 10 latest articles posty event
$args_latest = array(
    'numberposts' => 10,
    'post_type' => 'event',
);

$latest_books_event = get_posts($args_latest);

$latest_books_event1 = $latest_books_event['0'];
$latest_books_event2 = $latest_books_event['1'];

$thumbnail_url = get_the_post_thumbnail_url($latest_books_event1->ID);
$thumbnail_url2 = get_the_post_thumbnail_url($latest_books_event2->ID);

$sliced_array = array_slice($latest_books_event, 2, 3);
$thumbnail_url_loop = get_the_post_thumbnail_url(825);

// Get the 10 latest articles posty post
$args_latest_post = array(
    'numberposts' => 10,
    'post_type' => 'post',
);

$latest_books_post = get_posts($args_latest_post);
$latest_books_post1 = $latest_books_post['0'];
$thumbnail_url_post = get_the_post_thumbnail_url($latest_books_post1->ID, 'full');

$sliced_array_post = array_slice($latest_books_post, 1, 8);

$data = [
    'query_news' => $query_news,
    'query_event' => $query_event,
    'hight' => $hight,
    'single_post' => $single_post,
    'terms' => $terms,
    'terms_student' => $terms_student,
    'terms_research' => $terms_research,
    'queried_object' => $queried_object,
    'single_post_event' => $single_post_event,
    'latest_books_event1' => $latest_books_event1,
    'latest_books_event2' => $latest_books_event2,
    'thumbnail_url' => $thumbnail_url,
    'thumbnail_url2' => $thumbnail_url2,
    'sliced_array' => $sliced_array,
    'thumbnail_url_looppp' => $thumbnail_url_looppp,
    'latest_books_post' => $latest_books_post,
    'latest_books_post1' => $latest_books_post1,
    'thumbnail_url_post' => $thumbnail_url_post,
    'sliced_array_post' => $sliced_array_post,
];
if (get_post_type() == 'business' && !is_single()) {
    $args_business = [
        'post_type' => 'business',
        'posts_per_page' => 6,
        'paged' => $paged,
    ];
    $query_business = new WP_Query($args_business);

    $terms_business = get_terms(array(
        'taxonomy' => 'list-business',
        'hide_empty' => false,
        'posts_per_page' => 3,
        'parent' => 0,
    ));

    $object_current = get_queried_object();

    // echo "<pre>";
    // var_dump($object_current->post_name);

    $data = [
        'query_business' => $query_business,
        'terms_business' => $terms_business,
        'object_current' => $object_current,
    ];

    view('pages/business-partnerships', $data);
} elseif (get_post_type() == 'course' && !is_single()) {
    $args_course = [
        'post_type' => 'course',
        'posts_per_page' => -1,
        'paged' => $paged,
    ];
    $query_course = new WP_Query($args_course);

    $object_current = get_queried_object();
    $terms = get_terms(array(
        'taxonomy' => 'list-course',
        'hide_empty' => false,
    ));

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

    $url_param = basename($_SERVER['REQUEST_URI']);

    $highlight = [
        'posts_per_page' => 1,
        'meta_key' => 'highlight',
        'meta_value' => 'yes',
        'post_type' => 'news',
    ];
    $hight = new WP_Query($highlight);

    $args_news = [
        'post_type' => 'news',
        'posts_per_page' => 2,
        'paged' => $paged,
        'post__not_in' => array($hight->post->ID),
    ];
    $query_news = new WP_Query($args_news);

    $data = [
        'query_course' => $query_course,
        'terms' => $terms,
        'object_current' => $object_current,
        'hight' => $hight,
        'query_news' => $query_news,
    ];
    view('pages/course', $data);
} elseif (get_post_type() == 'research' && !is_single()) {
    $args_research = [
        'post_type' => 'research',
        'posts_per_page' => 6,
        'paged' => $paged,
    ];
    $query_research = new WP_Query($args_research);

    $terms_research = get_terms(array(
        'taxonomy' => 'list-research',
        'hide_empty' => false,
        'posts_per_page' => 3,
    ));

    $object_current = get_queried_object();

    $data = [
        'query_research' => $query_research,
        'terms_research' => $terms_research,
        'object_current' => $object_current,
    ];

    view('pages/research', $data);
} elseif (get_post_type() == 'news' && !is_single()) {
    $args = [
        'post_type' => 'news',
        'post_status' => 'publish',
        'meta_query' => [
            [
                'key' => 'highlight',
                'value' => 'yes',
                'compare' => '=',
            ],
            [
                'key' => 'display_home',
                'value' => 'yes',
                'compare' => '=',
            ],
            [
                'key' => 'order_field',
                'value' => 0,
                'compare' => '>',
            ],
        ],
        'meta_key' => 'order_field',
        'orderby' => array(
            'meta_value' => 'ASC',
            'date' => 'DESC',
        ),
        'ignore_sticky_posts' => true,
        'posts_per_page' => 4,
        'paged' => false,
        'taxonomy' => 'list-news',

    ];

    $query = new \WP_Query($args);
    $terms = get_terms(array(
        'taxonomy' => 'list-news',
        'hide_empty' => true,
        'parent' => 0,
        'meta_query' => array(
            array(
                'key' => 'show_news',
                'value' => 'yes',
                'compare' => '=',
            ),
        ),
    ));
    $args_soft_new = array(
        'taxonomy' => 'list-news',
        'hide_empty' => false,
        'posts_per_page' => -1,
        'orderby' => 'meta_value_num',
        'meta_key' => 'order_new',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'display_menu',
                'value' => 'yes',
                'compare' => '=',
            ),
        ),
    );

    $soft_new = get_terms($args_soft_new);
    $data = [
        'query' => $query,
        'terms' => $terms,
        'soft_new' => $soft_new,
    ];

    view('pages/news', $data);
} elseif (get_post_type() == 'event' && !is_single()) {
    $object_current = get_queried_object();
    $terms = get_terms(array(
        'taxonomy' => 'list-event',
        'hide_empty' => false,
    ));

    $single = [
        'posts_per_page' => 1,
        'orderby' => 'rand',
        'post_type' => 'event',
    ];
    $single_post = new WP_Query($single);

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

    $url_param = basename($_SERVER['REQUEST_URI']);

    $date_current = $_GET['date'];

    $get_date = explode("-", $date_current);
    $year_current = $get_date['0'];
    $month_current = $get_date['1'];
    $day_current = $get_date['2'];

    $today = current_time('d M, y');

    $time = strtotime(get_field('date_start', get_the_ID()));
    $time_url = strtotime($_GET['date']);

    $args_event = [];

    if ($_GET['date']) {
        $args_event = array(
            'post_count' => 5,
            'post_type' => 'event',
            'meta_query' => array(
                array(
                    'key' => 'date_start',
                    'compare' => '>',
                    'value' => $_GET['date'],
                    'type' => 'DATETIME',
                ),
            ),
            'order' => 'ASC',
            'orderby' => 'meta_value',
        );
    } else {
        $args_event = [
            'post_type' => 'event',
            'posts_per_page' => -1,
            'paged' => $paged,
        ];
    }

    $query_event = new WP_Query($args_event);

    $data = [
        'query_event' => $query_event,
        'terms' => $terms,
        'object_current' => $object_current,
        'hight' => $hight,
        'slip_date' => $slip_date,
        'month_current' => $month_current,
        'day_current' => $day_current,
        'single_post' => $single_post,
        'actual_link' => $actual_link,
        'url_param' => $url_param,
    ];

    view('pages/events', $data);
} elseif (get_post_type() == 'library' && !is_single()) {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args_library = [
        'post_type' => 'library',
        'posts_per_page' => 6,
        'paged' => $paged,
    ];
    $query_library = new WP_Query($args_library);

    $object_current = get_queried_object();
    $terms = get_terms(array(
        'taxonomy' => 'list-library',
        'hide_empty' => false,
    ));

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

    $url_param = basename($_SERVER['REQUEST_URI']);

    $total = $query_library->max_num_pages;

    $args_soft_library = array(
        'post_type' => 'library',
        'hide_empty' => false,
        'posts_per_page' => -1,
        'orderby' => 'meta_value_num',
        'meta_key' => 'order_library',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'order_library',
                'type' => 'numeric',
                'value' => 1,
                'compare' => '>=',
            ),
        ),
    );

    $soft_library = get_posts($args_soft_library);

    $data = [
        'query_lybrary' => $query_library,
        'terms' => $terms,
        'object_current' => $object_current,
        'query_library' => $query_library,
        'soft_library' => $soft_library,
        'paged' => $paged,
        'total' => $total,
    ];

    view('pages.library', $data);
} elseif (get_post_type() == 'student' && !is_single()) {
    $args_student = [
        'paged' => $paged,
        'post_type' => 'student',
        'posts_per_page' => 1,
    ];
    $query_student = new WP_Query($args_student);

    $object_current = get_queried_object();
    $terms = get_terms(array(
        'paged' => $paged,
        'taxonomy' => 'list-student',
        'hide_empty' => false,
        'posts_per_page' => 1,
    ));

    $terms_student = get_terms(array(
        'taxonomy' => 'list-student',
        'hide_empty' => false,
        'posts_per_page' => 6,

    ));

    $args_soft_students = array(
        'taxonomy' => 'list-student',
        'hide_empty' => false,
        'posts_per_page' => -1,
        'orderby' => 'meta_value_num',
        'meta_key' => 'order_students',
        'order' => 'ASC',
        'parent' => 0,
        'meta_query' => array(
            array(
                'key' => 'order_students',
                'type' => 'numeric',
                'value' => 1,
                'compare' => '>=',
            ),
        ),
    );

    $soft_students = get_terms($args_soft_students);

    $data = [
        'query_student' => $query_student,
        'terms' => $terms,
        'object_current' => $object_current,
        'terms_student' => $terms_student,
        'soft_students' => $soft_students,

    ];

    view('pages/student', $data);
} elseif (get_post_type() == 'about' && !is_single()) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

    $terms_about = get_terms(array(
        'taxonomy' => 'list-about',
        'hide_empty' => false,
        'posts_per_page' => 3,
        'parent' => 0,
    ));

    $data = [
        'query' => $wp_query,
        'term' => $term,
        'terms_about' => $terms_about,

    ];

    view('pages.taxonomy-about', $data);
} elseif (get_post_type() == 'about' && !is_single()) {
    $terms_admission = get_terms(array(
        'taxonomy' => 'list-admission',
        'hide_empty' => false,
        'posts_per_page' => 3,
    ));

    $queried_object = get_queried_object();
    $taxonomy = $queried_object->taxonomy;
    $term_id = $queried_object->term_id;

    $value_banner = get_field('anh_banner_admission', $taxonomy . '_' . $term_id);
    $content = get_field('content_admission', $queried_object);

    $data = [
        'terms_admission' => $terms_admission,
        'query' => $wp_query,
        'value_banner' => $value_banner,
        'content' => $content,
    ];

    view('pages.taxonomy-admission', $data);
} else {
    view('index', $data);
}
