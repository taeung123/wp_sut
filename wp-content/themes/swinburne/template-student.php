<?php
/**
 * Template Name: Student Template
 *
 */

$args_student = [
    'paged' => $paged,
    'post_type' => 'student',
    'posts_per_page' => 1,
];
$query_student = new WP_Query($args_student);

$object_current = get_queried_object();
$terms = get_terms(array(
    'paged' => $paged,
    'taxonomy' => 'list-student',
    'hide_empty' => false,
    'posts_per_page' => 1,
));

$terms_student = get_terms(array(
    'taxonomy' => 'list-student',
    'hide_empty' => false,
    'posts_per_page' => 6,
));

$args_soft_students = array(
    'taxonomy' => 'list-student',
    'hide_empty' => false,
    'posts_per_page' => -1,
    'orderby' => 'meta_value_num',
    'meta_key' => 'order_students',
    'order' => 'ASC',
    'parent' => 0,
    'meta_query' => array(
        array(
            'key' => 'order_students',
            'type' => 'numeric',
            'value' => 1,
            'compare' => '>=',
        ),
    ),
);

$soft_students = get_terms($args_soft_students);
// echo "<pre>";
// var_dump($terms_student);

$data = [
    'query_student' => $query_student,
    'terms' => $terms,
    'object_current' => $object_current,
    'terms_student' => $terms_student,
    'soft_students' => $soft_students,

];

view('pages/student', $data);
