<?php
/**
 * Template Name: Diplomas Template
 *
 */

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args_diplomas = [
	'post_type' => 'diplomas',
	'posts_per_page' => 6,
	'paged' => $paged,
];
$query_diplomas = new WP_Query($args_diplomas);
$total = $query_diplomas->max_num_pages;

$object_current = get_queried_object();
$terms = get_terms(array(
	'taxonomy' => 'list-diplomas',
	'hide_empty' => false,
));

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$url_param = basename($_SERVER['REQUEST_URI']);
// echo "<pre>";
// var_dump($terms);

$data = [
	'query_diplomas' => $query_diplomas,
	'terms' => $terms,
	'object_current' => $object_current,
	'paged' => $paged,
	'total' => $total,
];

view('pages/diplomas', $data);