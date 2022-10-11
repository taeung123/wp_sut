<?php
/**
 * Template Name: Life Template
 *
 */
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args_life = [
	'post_type' => 'life',
	'posts_per_page' => 6,
	'paged' => $paged,
];
$query_life = new WP_Query($args_life);

$object_current = get_queried_object();
$terms = get_terms(array(
	'taxonomy' => 'list-life',
	'hide_empty' => false,
));

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$url_param = basename($_SERVER['REQUEST_URI']);

$total = $query_life->max_num_pages;

$data = [
	'query_life' => $query_life,
	'terms' => $terms,
	'object_current' => $object_current,
	'query_life' => $query_life,
	'paged' => $paged,
	'total' => $total,
];

view('pages/life', $data);