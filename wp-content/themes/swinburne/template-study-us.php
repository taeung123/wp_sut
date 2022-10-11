<?php
/**
 * Template Name: Study with us Template
 *
 */

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

$current_slug = get_queried_object()->slug;
$current_id = get_queried_object()->term_id;
$query_news = new WP_Query(
	[
		'post_type' => 'news',
		'posts_per_page' => -1,
		'order ' => 'DESC',
		'tax_query' => array(                                
			array(
				'taxonomy' => 'list-news',
				'field' => 'slug', 
				'terms' => [$current_slug],
				'include_children' => true,
				'operator' => 'IN' 
			)
		)
	]
);

$highlight = [
	'posts_per_page' => 1,
	'meta_key' => 'highlight',
	'meta_value' => 'yes',
	'post_type' => 'news',
];
$hight = new WP_Query($highlight);

$data = [
	'query_course' => $query_course,
	'terms' => $terms,
	'object_current' => $object_current,
	'query_news' => $query_news,
];
view('pages/study-us', $data);