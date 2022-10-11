<?php
/**
 * Template Name: Primary Template
 *
 */

$object_current = get_queried_object();

$data = [
	'object_current' => $object_current
];
view('pages.primary', $data);