<?php
/**
 * Template Name: Contact Template
 * 
 */

$object_current = get_queried_object();
// $url_param = basename($_SERVER['REQUEST_URI']);


// echo "<pre>";
// var_dump($url_param);


$data = [
	'object_current' => $object_current,
];

view('pages/contact', $data);