<?php 	
/**
 * Template Name: Research Template
 * 
 */

 
 $args_research = [
	'post_type'      => 'research',
	'posts_per_page' => 6,
	'paged' => $paged,
];
$query_research = new WP_Query($args_research);
$terms_research = get_field('display_taxs');
//var_dump($display_taxs);

// $terms_research = get_terms( array(
//     'taxonomy' => 'list-research',
//     'hide_empty' => false,
//     'posts_per_page' => 3,
// ) );

$object_current = get_queried_object();

$data = [
	'query_research' => $query_research,
	'terms_research' => $terms_research,
	'object_current' => $object_current,
];


view('pages/research', $data);