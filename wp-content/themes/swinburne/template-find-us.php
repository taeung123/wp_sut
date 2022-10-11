<?php
/**
 * Template Name: FInd-us Template
 * 
 */







$object_current = get_queried_object();

$data = [
	'object_current' => $object_current,
];

	// echo "<pre>";
	// var_dump($object_current);

view('pages/find-us', $data);