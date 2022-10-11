<?php
/**
 * Template Name: International Template
 *
 */
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args_international = [
	'post_type' => 'international',
	'posts_per_page' => 6,
	'paged' => $paged,
];
$query_international_post = new WP_Query($args_international);
$total = $query_international_post->max_num_pages;
$object_current = get_queried_object();
$terms = get_terms(array(
	'taxonomy' => 'list-international',
	'hide_empty' => false,
));

// echo "<pre>";
// var_dump($terms);
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$url_param = basename($_SERVER['REQUEST_URI']);

$data = [
	'query_international_post' => $query_international_post,
	'terms' => $terms,
	'object_current' => $object_current,
	'paged' => $paged,
	'total' => $total,
];

view('pages/international', $data);