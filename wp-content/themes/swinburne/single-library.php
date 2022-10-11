<?php

$args_library = [
	'post_type' => 'library',
	'posts_per_page' => 3,
	'paged' => $paged,
];
$query_library = new WP_Query($args_library);


$data = [
	'query_library' => $query_library,
];
view('single', $data);