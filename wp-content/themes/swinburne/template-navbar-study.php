<?php
/**
 * Template Name: Navbar study Template
 * 
 */

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";


$data = [
	'query_research' => $query_research,
	'terms_research' => $terms_research,
	'object_current' => $object_current,
];


view('pages/navbar-study',);