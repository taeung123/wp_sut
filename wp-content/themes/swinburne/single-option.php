<?php

$terms = wp_get_post_terms(get_the_ID(), 'list-option');
// echo "<pre>";
// var_dump($terms['0'] ->name);

$term_current = $terms['0']->term_id;
$args_option = [
	'post_type' => 'option',
	'posts_per_page' => 3,
	'tax_query' => array(
		array(
			'taxonomy' => 'list-option',
			'field' => 'id',
			'terms' => $term_current, // Where term_id of Term 1 is "1".
			'include_children' => false,
		),
	),
];
$title = $terms['0']->name;
// var_dump($title);
$query_option = new WP_Query($args_option);

$args_option_post = [
	'post_type' => 'option',
	'posts_per_page' => 3,
	'post__not_in' => array(get_the_ID()),
	'paged' => $paged,
];
$query_option_post = new WP_Query($args_option_post);
// echo "<pre>";
// var_dump($terms);

$data = [
	'query_option' => $query_option,
	'title' => $title,
	'query_option_post' => $query_option_post,
];

view('single', $data);