<?php

$terms = wp_get_post_terms(get_the_ID(), 'list-admission');

$term_current = $terms['0']->term_id;
$args_admission = [
	'post_type' => 'admission',
	'posts_per_page' => 3,
	'post__not_in' => array(get_the_ID()),
	'tax_query' => array(
		array(
			'taxonomy' => 'list-admission',
			'field' => 'id',
			'terms' => $term_current, // Where term_id of Term 1 is "1".
			'include_children' => false,
		),
	),
];
$title = $terms['0']->name;
// var_dump($title);
$query_admission = new WP_Query($args_admission);

// echo "<pre>";
// var_dump($terms);

$data = [
	'query_admission' => $query_admission,
	'title' => $title,
];

view('single', $data);