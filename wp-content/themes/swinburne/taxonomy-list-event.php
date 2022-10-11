<?php

$terms = get_terms(array(
	'taxonomy' => 'list-event',
	'hide_empty' => false,
));

$highlight = [
	'posts_per_page' => 1,
	'meta_key' => 'highlight',
	'meta_value' => 'yes',
];

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$url_param = basename($_SERVER['REQUEST_URI']);

// echo "<pre>";
// var_dump($actual_link);

$hight = new WP_Query($highlight);

$data = [
	'terms' => $terms,
	'query' => $wp_query,
	'hight' => $hight,
];

view('pages.taxonomy-event', $data);