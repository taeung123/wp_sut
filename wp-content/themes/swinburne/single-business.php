<?php

$terms = wp_get_post_terms(get_the_ID(), 'list-business');

$term_current = $terms['0']->term_id;
$args_business = [
	'post_type' => 'business',
	'post__not_in' => get_the_ID(),
	'posts_per_page' => 3,
	'post__not_in' => array(get_the_ID()),
	'tax_query' => array(
		array(
			'taxonomy' => 'list-business',
			'field' => 'id',
			'terms' => $term_current, // Where term_id of Term 1 is "1".
			'include_children' => false,
		),
	),
];
$title = $terms['0']->name;
// var_dump($title);
$query_business = new WP_Query($args_business);

// echo "<pre>";
// var_dump($terms);

$data = [
	'query_business' => $query_business,
	'title' => $title,
];

view('single', $data);