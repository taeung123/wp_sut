<?php
/**
 * Template Name: Study with us course Template
 * 
 */

$args_course = [
	'post_type'      => 'course',
	'posts_per_page' => -1,
	'paged' => $paged,
];
$query_course = new WP_Query($args_course);

$object_current = get_queried_object();
$terms = get_terms( array(
    'taxonomy' => 'list-course',
    'hide_empty' => false,
) );

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$url_param = basename($_SERVER['REQUEST_URI']);

$highlight = [
	'posts_per_page' => 1,
	'meta_key'		=> 'highlight',
	'meta_value'	=> 'yes',
	'post_type'      => 'news',
];
$hight = new WP_Query($highlight);


$args_news = [
	'post_type'      => 'news',
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