<?php

$terms = wp_get_post_terms( get_the_ID(),'list-international' );
// echo "<pre>";
// var_dump($terms['0'] ->name);

$term_current = $terms['0'] ->term_id;
$args_international = [
    'post_type'      => 'international',
    'posts_per_page' => 3,
     'tax_query' => array(
    array(
      'taxonomy' => 'list-international',
      'field' => 'id',
      'terms' => $term_current, // Where term_id of Term 1 is "1".
      'include_children' => false,
    )
)
];
$title = $terms['0'] ->name;
// var_dump($title);
$query_international = new WP_Query($args_international);


// echo "<pre>";
// var_dump($terms);


$data = [
    'query_international' => $query_international,
    'title' => $title,
];


view('single', $data);