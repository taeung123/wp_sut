<?php

$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

$terms_about = get_terms(array(
    'taxonomy' => 'list-about',
    'hide_empty' => false,
    'posts_per_page' => 3,
    'parent' => 0,
));

$data = [
    'query' => $wp_query,
    'term' => $term,
    'terms_about' => $terms_about,

];

view('pages.taxonomy-about', $data);
