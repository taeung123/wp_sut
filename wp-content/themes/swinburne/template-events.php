<?php
/**
 * Template Name: Events Template
 *
 */

$object_current = get_queried_object();
$terms = get_terms(array(
	'taxonomy' => 'list-event',
	'hide_empty' => false,
));

// $highlight = [
// 	'posts_per_page' => 1,
// 	'meta_key'		=> 'highlight',
// 	'meta_value'	=> 'yes'
// ];
// $hight = new WP_Query($highlight);

$single = [
	'posts_per_page' => 1,
	'orderby' => 'rand',
	'post_type' => 'event',
];
$single_post = new WP_Query($single);

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$url_param = basename($_SERVER['REQUEST_URI']);

$date_current = $_GET['date'];

$get_date = explode("-", $date_current);
$year_current = $get_date['0'];
$month_current = $get_date['1'];
$day_current = $get_date['2'];

// echo "<pre>";
// var_dump($month_current);

$today = current_time('d M, y');

// var_dump(get_field('date_start', 260));
// var_dump($_GET['date']);
// $slip_date = explode("/", get_field('date_start', 260));
// $slip_date_end = explode("/", get_field('date_end', 260));

// echo "<pre>";
// var_dump($slip_date['0']);
// var_dump($slip_date['1']);

$time = strtotime(get_field('date_start', get_the_ID()));
$time_url = strtotime($_GET['date']);

$args_event = [];

if ($_GET['date']) {
	$args_event = array(
		'post_count' => 5,
		'post_type' => 'event',
		'meta_query' => array(
			array(
				'key' => 'date_start',
				'compare' => '>',
				'value' => $_GET['date'],
				'type' => 'DATETIME',
			),
		),
		'order' => 'ASC',
		'orderby' => 'meta_value',
	);
} else {
	$args_event = [
		'post_type' => 'event',
		'posts_per_page' => -1,
		'paged' => $paged,
	];
}

$query_event = new WP_Query($args_event);

$data = [
	'query_event' => $query_event,
	'terms' => $terms,
	'object_current' => $object_current,
	'hight' => $hight,
	'hight' => $hight,
	'slip_date' => $slip_date,
	'month_current' => $month_current,
	'day_current' => $day_current,
	'single_post' => $single_post,
	'actual_link' => $actual_link,
	'url_param' => $url_param,
];

view('pages/events', $data);