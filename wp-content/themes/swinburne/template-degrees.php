<?php
/**
 * Template Name: Degrees Template
 *
 */

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args_degrees = [
	'post_type' => 'degrees',
	'posts_per_page' => 6,
	'paged' => $paged,
];
$query_degrees = new WP_Query($args_degrees);
$total = $query_degrees->max_num_pages;

$object_current = get_queried_object();
$terms = get_terms(array(
	'taxonomy' => 'list-degrees',
	'hide_empty' => false,
));

// echo "<pre>";
// var_dump($terms);
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$url_param = basename($_SERVER['REQUEST_URI']);

$data = [
	'query_degrees' => $query_degrees,
	'terms' => $terms,
	'object_current' => $object_current,
	'paged' => $paged,
	'total' => $total,
];

view('pages/degrees', $data);