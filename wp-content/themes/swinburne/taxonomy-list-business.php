<?php

$terms_business = get_terms(array(
	'taxonomy' => 'list-business',
	'hide_empty' => false,
	'posts_per_page' => 3,
));

$queried_object = get_queried_object();
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;

$value_banner = get_field('anh_banner_business', $taxonomy . '_' . $term_id);
$current_slug = get_queried_object()->slug;
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

$data = [
	'terms_business' => $terms_business,
	'query' => $wp_query,
	'value_banner' => $value_banner,
	'query_tag' => $query_tag
];
view('pages.taxonomy-business', $data);