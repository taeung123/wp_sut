<?php

$terms_refer = get_terms(array(
	'taxonomy' => 'list-download',
	'hide_empty' => false,
	'posts_per_page' => 3,
));

$object_current = get_queried_object();

$data = [
	'terms_refer' => $terms_refer,
	'query' => $wp_query,
	'object_current' => $object_current,
];

view('pages.taxonomy-download', $data);
