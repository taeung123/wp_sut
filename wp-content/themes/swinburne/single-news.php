<?php
$terms = wp_get_post_terms(get_the_ID(), 'list-news');
// echo "<pre>";
// var_dump($terms['0'] ->name);

$term_current = $terms['0']->term_id;
$args_news = [
    'post_type' => 'news',
    'posts_per_page' => 6,
    'post__not_in' => array(get_the_ID()),
    'tax_query' => array(
        array(
            'taxonomy' => 'list-news',
            'field' => 'id',
            'terms' => $term_current, // Where term_id of Term 1 is "1".
            'include_children' => false,
        ),
    ),
];
$title = $terms['0']->name;
// var_dump($title);
$query_news = new WP_Query($args_news);

// echo "<pre>";
// var_dump($terms);

$data = [
    'query_news' => $query_news,
    'title' => $title,
];

view('single', $data);
