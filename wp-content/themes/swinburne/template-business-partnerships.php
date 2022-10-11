<?php
/**
 * Template Name: Business-partnerships Template
 *
 */

$args_business = [
	'post_type' => 'business',
	'posts_per_page' => 6,
	'paged' => $paged,
];
$query_business = new WP_Query($args_business);

$terms_business = get_terms(array(
	'taxonomy' => 'list-business',
	'hide_empty' => false,
	'posts_per_page' => 3,
));

$current_slug = get_queried_object()->post_name;
$current_id = get_queried_object()->term_id;
$query_tag = new WP_Query(
	[
		'post_type' => 'news',
		'posts_per_page' => -1,
		'order ' => 'DESC',
		'tax_query' => array(                                
			array(
				'taxonomy' => 'list-news',
				'field' => 'slug', 
				'terms' => [$current_slug],
				'include_children' => true,
				'operator' => 'IN' 
			)
		)
	]
);

$object_current = get_queried_object();

// echo "<pre>";
// var_dump($object_current->post_name);

$data = [
	'query_business' => $query_business,
	'terms_business' => $terms_business,
	'object_current' => $object_current,
	'query_tag' => $query_tag,
];

view('pages/business-partnerships', $data);