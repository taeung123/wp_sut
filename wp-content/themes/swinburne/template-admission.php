<?php
/**
 * Template Name: Admission Template
 *
 */

$args_admission = [
    'post_type' => 'admission',
    'posts_per_page' => 6,
    'paged' => $paged,
];
$query_admission = new WP_Query($args_admission);

$terms_admission = get_terms(array(
    'taxonomy' => 'list-admission',
    'hide_empty' => false,
    'posts_per_page' => 3,
    'parent' => 0,
));

$object_current = get_queried_object();

$current_slug = get_queried_object()->post_name;
$current_id = get_queried_object()->term_id;
$query_news = new WP_Query(
    [
        'post_type' => 'news',
        'posts_per_page' => -1,
        'order ' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'list-news',
                'field' => 'slug',
                'terms' => [$current_slug],
                'include_children' => true,
                'operator' => 'IN',
            ),
        ),
    ]
);

$data = [
    'query_admission' => $query_admission,
    'terms_admission' => $terms_admission,
    'object_current' => $object_current,
    'query_news' => $query_news,
];

view('pages/admission', $data);
