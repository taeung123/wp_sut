<?php
/**
 * Template Name: Refer Template
 * 
 */

$args_refer = [
	'post_type'      => 'refer',
	'posts_per_page' => 6,
	'paged' => $paged,
];
$query_refer = new WP_Query($args_refer);




$terms_refer = get_terms( array(
    'taxonomy' => 'list-refer',
    'hide_empty' => false,
    'posts_per_page' => 3,
) );

$object_current = get_queried_object();


// echo "<pre>";
// var_dump($terms_refer);

$data = [
	'query_refer' => $query_refer,
	'terms_refer' => $terms_refer,
	'object_current' => $object_current,
];


view('pages/refer', $data);