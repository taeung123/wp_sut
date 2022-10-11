<?php

/**
 * Template Name: News Template
 *
 */
$object = get_queried_object();

$args = [
    'post_type' => 'news',
    'post_status' => 'publish',
    'meta_query' => [
        [
            'key' => 'highlight',
            'value' => 'yes',
            'compare' => '=',
        ],
        [
            'key' => 'display_home',
            'value' => 'yes',
            'compare' => '=',
        ],
        [
            'key' => 'order_field',
            'value' => 0,
            'compare' => '>',
        ],
    ],
    'meta_key' => 'order_field',
    'orderby' => array(
        'meta_value' => 'ASC',
        'date' => 'DESC',
    ),
    'ignore_sticky_posts' => true,
    'posts_per_page' => 4,
    'paged' => false,
    'taxonomy' => 'list-news',

];
$query = new \WP_Query($args);
$terms = get_terms(array(
    'taxonomy' => 'list-news',
    'hide_empty' => true,
    'parent' => 0,
    'meta_query' => array(
        array(
            'key' => 'show_news',
            'value' => 'yes',
            'compare' => '=',
        ),
    ),
));
$args_soft_new = array(
    'taxonomy' => 'list-news',
    'hide_empty' => false,
    'posts_per_page' => -1,
    'orderby' => 'meta_value_num',
    'meta_key' => 'order_new',
    'meta_query' => array(
        array(
            'key' => 'display_menu',
            'value' => 'yes',
            'compare' => '=',
        ),
    ),
);

$soft_new = get_terms($args_soft_new);
$data = [
    'query' => $query,
    'terms' => $terms,
    'soft_new' => $soft_new,
];

view('pages/news', $data);
