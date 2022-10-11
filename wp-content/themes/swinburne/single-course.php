<?php

$args_course = [
	'post_type' => 'course',
	'posts_per_page' => 1,
	'paged' => $paged,
	'p' => $_GET['post_id'],
];
$query_course = new WP_Query($args_course);

$terms = get_terms(array(
	'taxonomy' => 'list-course',
	'hide_empty' => false,
));

$term_current = get_queried_object()->term_id;

$name_by_term = get_term_by('id', $term_current, 'list-course');

// echo "<pre>";
// var_dump($hight_show);

$data = [
	'query' => $wp_query,
	'query_course' => $query_course,
	'selectOption' => $selectOption,
	'name_by_term' => $name_by_term,
	'hight_show' => $hight_show,

];

view('single', $data);