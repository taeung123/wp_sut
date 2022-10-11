<?php

$args_event = [
	'post_type' => 'event',
	'post__not_in' => array(get_the_ID()),
	'posts_per_page' => 3,
];
$query_event = new WP_Query($args_event);

$data = [
	'query_event' => $query_event,
];

view('single', $data);