<?php

$args_news = [
    'post_type' => 'post',
    'posts_per_page' => 3,
    'paged' => $paged,
];
$query_news = new WP_Query($args_news);
// Bài viết nổi bật

$object_current = get_queried_object();
// echo "<pre>";
// var_dump($object_current);

$data = [
    'object_current' => $object_current,
    'query_news' => $query_news,
];

view('single', $data);
