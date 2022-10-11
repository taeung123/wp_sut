<?php
/**
 * Template Name: Option Template
 *
 */

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$object_current = get_queried_object();
$args_option = [
	'post_type' => 'option',
	'posts_per_page' => 6,
	'paged' => $paged,
	'tax_query' => [
		[
			'taxonomy' => 'list-option',              
			'field' => 'slug',                    
			'terms' => [$object_current->post_name],
		]
	] 
];
$query_option = new WP_Query($args_option);

$terms = get_terms(array(
	'taxonomy' => 'list-option',
	'hide_empty' => false,
));

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$url_param = basename($_SERVER['REQUEST_URI']);

$total = $query_option->max_num_pages;

$data = [
	'query_option' => $query_option,
	'terms' => $terms,
	'object_current' => $object_current,
	'query_option' => $query_option,
	'paged' => $paged,
	'total' => $total,
];

view('pages/option', $data);