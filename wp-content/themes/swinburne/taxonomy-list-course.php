<?php

$args_course = [
	'post_type' => 'course',
	'posts_per_page' => 1,
	'paged' => $paged,
	'p' => $_GET['post_id'],
];
$query_course = new WP_Query($args_course);

$terms = get_terms(array(
	'taxonomy' => 'list-course',
	'hide_empty' => false,
));

$term_current = get_queried_object()->term_id;

$name_by_term = get_term_by('id', $term_current, 'list-course');

$args_tag = [
	'post_type' => 'news',
	'posts_per_page' => 1,
	'paged' => $paged,
];

$current_slug = get_queried_object()->slug;
$current_id = get_queried_object()->term_id;
$query_tag = new WP_Query(
	[
		'post_type' => 'news',
		'posts_per_page' => -1,
		'order ' => 'DESC',
		'taxonomy' => 'list-news',
		'meta_query' => array(
			array(
				'key' => 'show_tax',
				'value' => $current_id,
				'compare' => 'like',
			),
		),
	]
);

$highlight = [
	'posts_per_page' => 3,
	'meta_key' => 'show_single_course',
	'meta_value' => 'show',
	'post_type' => 'news',
];
$hight_show = new WP_Query($highlight);

$queried_object = get_queried_object();
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;
$value_banner = get_field('anh_banner_course', $taxonomy . '_' . $term_id);

//lấy link downlad tài liệu từng khóa học
$sort_url_cource = explode('/', $_SERVER["REQUEST_URI"]);
$download_course_all = (pll_current_language('slug') === 'vi') ? $sort_url_cource[2] : $sort_url_cource[3];
if (pll_current_language('slug') === 'vi') {
	$category_download = get_term_by('slug', $download_course_all, 'list-download');
	$category_id_download = $category_download->term_id;
	$link_cource_download = get_term_link($category_id_download);
} else {
	$category_download = get_term_by('slug', $download_course_all, 'list-download');
	$category_id_download = $category_download->term_id;
	$link_cource_download = get_term_link($category_id_download);
}

$data = [
	'query' => $wp_query,
	'query_course' => $query_course,
	'selectOption' => $selectOption,
	'name_by_term' => $name_by_term,
	'hight_show' => $hight_show,
	'query_tag' => $query_tag,
	'value_banner' => $value_banner,
	'link_cource_download' => $link_cource_download,
];

view('pages.taxonomy-course', $data);