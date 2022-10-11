<?php

$terms = wp_get_post_terms(get_the_ID(), 'list-degrees');
// echo "<pre>";
// var_dump($terms['0'] ->name);

$term_current = $terms['0']->term_id;
$args_degrees = [
	'post_type' => 'degrees',
	'posts_per_page' => 3,
	'tax_query' => array(
		array(
			'taxonomy' => 'list-degrees',
			'field' => 'id',
			'terms' => $term_current, // Where term_id of Term 1 is "1".
			'include_children' => false,
		),
	),
];
$title = $terms['0']->name;
// var_dump($title);
$query_degrees = new WP_Query($args_degrees);

// echo "<pre>";
// var_dump($terms);
$args_degrees_post = [
	'post_type' => 'degrees',
	'posts_per_page' => 3,
	'post__not_in' => array(get_the_ID()),
	'paged' => $paged,
];
$query_degrees_post = new WP_Query($args_degrees_post);

$data = [
	'query_degrees' => $query_degrees,
	'title' => $title,
	'query_degrees_post' => $query_degrees_post,
];

view('single', $data);