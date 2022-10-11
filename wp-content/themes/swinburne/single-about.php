<?php

$terms = wp_get_post_terms(get_the_ID(), 'list-about');
// echo "<pre>";
// var_dump($terms['0'] ->name);

$term_current = $terms['0']->term_id;
$args_about = [
	'post_type' => 'about',
	'posts_per_page' => 3,
	'post__not_in' => array(get_the_ID()),
	'tax_query' => array(
		array(
			'taxonomy' => 'list-about',
			'field' => 'id',
			'terms' => $term_current, // Where term_id of Term 1 is "1".
			'include_children' => false,
		),
	),
];
$title = $terms['0']->name;
// var_dump($title);
$query_about = new WP_Query($args_about);

// echo "<pre>";
// var_dump($terms);

$data = [
	'query_about' => $query_about,
	'title' => $title,
];

view('single', $data);