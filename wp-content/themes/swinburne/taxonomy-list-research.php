<?php


$terms_research = get_terms( array(
    'taxonomy' => 'list-research',
    'hide_empty' => false,
    'posts_per_page' => 3,
) );




$queried_object = get_queried_object();
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;

$value_banner = get_field( 'anh_banner_research', $taxonomy.'_'.$term_id);

$data = [
	'query' => $wp_query,
	'terms_research' => $terms_research,
	'value_banner' => $value_banner,
];

view('pages.taxonomy-research',$data);




