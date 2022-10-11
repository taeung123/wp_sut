<?php

$terms = wp_get_post_terms(get_the_ID(), 'list-graduate');
// echo "<pre>";
// var_dump($terms['0'] ->name);

$term_current = $terms['0']->term_id;
$args_graduate = [
	'post_type' => 'graduate',
	'posts_per_page' => 3,
	'post__not_in' => array(get_the_ID()),
	'tax_query' => array(
		array(
			'taxonomy' => 'list-graduate',
			'field' => 'id',
			'terms' => $term_current, // Where term_id of Term 1 is "1".
			'include_children' => false,
		),
	),
];
$title = $terms['0']->name;
// var_dump($title);
$query_graduate = new WP_Query($args_graduate);

// echo "<pre>";
// var_dump($terms);

$data = [
	'query_graduate' => $query_graduate,
	'title' => $title,
];

view('single', $data);