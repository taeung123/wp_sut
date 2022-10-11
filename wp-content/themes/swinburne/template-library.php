<?php
/**
 * Template Name: Library Template
 *
 */

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