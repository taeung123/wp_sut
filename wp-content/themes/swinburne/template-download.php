<?php
/**
 * Template Name: Download Template
 *
 */

$query_refer = new WP_Query($args_refer);

$terms_refer_id = get_terms(array(
	'taxonomy' => 'list-download',
));
$term_id = $terms_refer_id[0]->parent;
$terms_refer = get_terms(array(
	'taxonomy' => 'list-download',
	'hide_empty' => false,
	'posts_per_page' => 3,
	'parent' => $term_id,
));

$object_current = get_queried_object();

// echo "<pre>";
// var_dump($terms_refer);

$data = [
	'query_refer' => $query_refer,
	'terms_refer' => $terms_refer,
	'object_current' => $object_current,
];

view('pages/download', $data);