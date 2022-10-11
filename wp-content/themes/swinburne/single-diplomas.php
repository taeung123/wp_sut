<?php

$terms = wp_get_post_terms( get_the_ID(),'list-diplomas' );
// echo "<pre>";
// var_dump($terms['0'] ->name);

$term_current = $terms['0'] ->term_id;
$args_diplomas = [
    'post_type'      => 'diplomas',
    'posts_per_page' => 3,
     'tax_query' => array(
    array(
      'taxonomy' => 'list-diplomas',
      'field' => 'id',
      'terms' => $term_current, // Where term_id of Term 1 is "1".
      'include_children' => false,
    )
)
];
$title = $terms['0'] ->name;
// var_dump($title);
$query_diplomas = new WP_Query($args_diplomas);


// echo "<pre>";
// var_dump($terms);


$data = [
    'query_diplomas' => $query_diplomas,
    'title' => $title,
];


view('single', $data);