<?php


$terms_tintuc = get_terms( array(
    'taxonomy' => 'list-tintuc',
    'hide_empty' => false,
    'posts_per_page' => 3,
) );


// $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";




$data = [
	'query' => $wp_query,
	'terms_tintuc' => $terms_tintuc,
];

view('pages.taxonomy-tintuc',$data);




