<?php
/**
 * Template Name: Graduate Template
 *
 */

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args_graduate = [
	'post_type' => 'graduate',
	'posts_per_page' => 6,
	'paged' => $paged,
];
$query_graduate_post = new WP_Query($args_graduate);
$total = $query_graduate_post->max_num_pages;

$object_current = get_queried_object();
$terms = get_terms(array(
	'taxonomy' => 'list-graduate',
	'hide_empty' => false,
));

// echo "<pre>";
// var_dump($terms);
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$url_param = basename($_SERVER['REQUEST_URI']);

$data = [
	'query_graduate_post' => $query_graduate_post,
	'terms' => $terms,
	'object_current' => $object_current,
	'paged' => $paged,
	'total' => $total,
];

view('pages/graduate', $data);