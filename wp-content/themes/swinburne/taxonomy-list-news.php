<?php

$terms_news = get_terms(array(
    'taxonomy' => 'list-news',
    'hide_empty' => false,
    'posts_per_page' => 3,
));

$queried_object = get_queried_object();
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;

$value_banner = get_field('anh_banner_news', $taxonomy . '_' . $term_id);

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$total = $wp_query->max_num_pages;

$args = [
    'post_type' => 'news',
    'post_status' => 'publish',
    'meta_key' => 'order_field',
    'orderby' => array(
        'meta_value' => 'ASC',
        'date' => 'DESC',
    ),
    'ignore_sticky_posts' => true,
    'posts_per_page' => 4,
    'paged' => false,
    'taxonomy' => 'list-news',
    'tax_query' => [
        [
            'taxonomy' => 'list-news',
            'field' => 'term_id',
            'terms' => $term_id,
        ],
    ],
    'meta_query' => [
        [
            'key' => 'highlight',
            'value' => 'yes',
            'compare' => '=',
        ],
        [
            'key' => 'order_field',
            'value' => 0,
            'compare' => '>',
        ],
    ],
];
$query = new \WP_Query($args);

$data = [
    'query_topic' => $wp_query,
    'query' => $query,
    'terms_news' => $terms_news,
    'value_banner' => $value_banner,
    'paged' => $paged,
    'total' => $total,
];

view('pages.taxonomy-news', $data);
