<?php
/**
 * Template Name: About Template
 *
 */

$args_about = [
    'paged' => $paged,
    'post_type' => 'about',
    'posts_per_page' => 1,
];
$query_about = new WP_Query($args_about);

$object_current = get_queried_object();
$terms = get_terms(array(
    'paged' => $paged,
    'taxonomy' => 'list-about',
    'hide_empty' => false,
    'posts_per_page' => 1,
));

$args_soft_about = array(
    'taxonomy' => 'list-about',
    'hide_empty' => false,
    'posts_per_page' => -1,
    'orderby' => 'meta_value_num',
    'meta_key' => 'order_about',
    'order' => 'ASC',
    'parent' => 0,
    'meta_query' => array(
        array(
            'key' => 'order_about',
            'type' => 'numeric',
            'value' => 1,
            'compare' => '>=',
        ),
    ),
);

$soft_about = get_terms($args_soft_about);

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$data = [
    'query_about' => $query_about,
    'terms' => $terms,
    'object_current' => $object_current,
    'actual_link' => $actual_link,
    'soft_about' => $soft_about,

];

view('pages.about', $data);
