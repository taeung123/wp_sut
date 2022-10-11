<?php
/**
 * Template Name: index Template
 * 
 */
$args = [
	'posts_per_page' => 6,
	'paged' => $paged,
];

$highlight = [
	'posts_per_page' => 1,
	'meta_key' => 'highlight',
	'meta_value' => 'yes',
	'post_type' => 'news',
];
$object_current = get_queried_object();

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

$thumbnail_url = get_the_post_thumbnail_url($latest_books_event1->ID, 'full');
$thumbnail_url2 = get_the_post_thumbnail_url($latest_books_event2->ID);

$sliced_array = array_slice($latest_books_event, 2, 3);
$thumbnail_url_loop = get_the_post_thumbnail_url(825);

// Get the 10 latest articles posty post
$args_latest_post = array(
	'numberposts' => 10,
	'post_type' => 'news',
);

$latest_books_post = get_posts($args_latest_post);

$latest_books_post1 = $latest_books_post['0'];
$thumbnail_url_post = get_the_post_thumbnail_url($latest_books_post1->ID, 'full');

$sliced_array_post = array_slice($latest_books_post, 1, 8);

// echo "<pre>";
// var_dump($latest_books_event1->guid );
// die();

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
	'object_current' => $object_current,
];

view('index', $data);
