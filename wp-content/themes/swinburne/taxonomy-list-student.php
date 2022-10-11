<?php

$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

$terms_student = get_terms(array(
    'taxonomy' => 'list-student',
    'hide_empty' => false,
    'posts_per_page' => 6,
    'parent' => 0,
));

$current_slug = get_queried_object()->slug;
$query_tag = new WP_Query(
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
    'query' => $wp_query,
    'term' => $term,
    'terms_student' => $terms_student,
    'query_tag' => $query_tag,
];

view('pages.taxonomy-student', $data);
