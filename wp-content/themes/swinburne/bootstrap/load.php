<?php

/**
 * Enqueue scripts and stylesheet
 */
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
add_action('wp_enqueue_scripts', 'theme_enqueue_style');

function nf_opensans() {
	$fonts_url = '';
	$opensans = _x('on', 'Opensans font: on or off', 'vicoders');
	if ('off' !== $opensans) {
		$query_args = array(
			'family' => 'Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i',
			'subset' => urlencode('latin,latin-ext'),
		);
	}
	$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
	return esc_url_raw($fonts_url);
}

/**
 * Theme support
 */
add_theme_support('post-thumbnails');

function theme_enqueue_style() {
	wp_enqueue_style('nf-opensans-font', nf_opensans(), array(), null);
	wp_enqueue_style(
		'template-style',
		asset('app.css'),
		false
	);
}

function theme_enqueue_scripts() {
	wp_enqueue_script(
		'template-scripts',
		asset('app.js'),
		'jquery',
		'1.0',
		true
	);

	$protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';

	$params = array(
		'ajax_url' => admin_url('admin-ajax.php', $protocol),
	);
	wp_localize_script('template-scripts', 'ajax_obj', $params);

	$js_vars = array(
		'endpoint' => esc_url_raw(rest_url('/wp/v2/media/')),
		'nonce' => wp_create_nonce('wp_rest'),
	);
	wp_localize_script('template-scripts', 'rest_media', $js_vars);
}

if (!function_exists('themeSetup')) {
	/**
	 * setup support for theme
	 *
	 * @return void
	 */
	function themeSetup() {
		// Register menus
		register_nav_menus(array(
			'first-menu' => __('First Menu', 'vicoders'),
			'second-menu' => __('Second Menu', 'vicoders'),
			'study-menu' => __('Study Menu', 'vicoders'),
			'footer_col1' => __('Footer Col1', 'vicoders'),
			'footer_col2' => __('Footer Col2', 'vicoders'),
			'footer_col3' => __('Footer Col3', 'vicoders'),
			'footer_col4' => __('Footer Col4', 'vicoders'),
		));

	}

	add_action('after_setup_theme', 'themeSetup');
}

if (!function_exists('themeSidebars')) {
	/**
	 * register sidebar for theme
	 *
	 * @return void
	 */
	function themeSidebars() {
		$sidebars = [
			[
				'name' => __('Sidebar', 'vicoders'),
				'id' => 'main-sidebar',
				'description' => __('Main Sidebar', 'vicoders'),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h2 class="widget-title">',
				'after_title' => '</h2>',
			],
			[
				'name' => __('Footer Intro Sidebar', 'vicoders'),
				'id' => 'footer-intro-sidebar',
				'description' => __('Footer Sidebar', 'vicoders'),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h2 class="widget-title">',
				'after_title' => '</h2>',
			],
		];

		foreach ($sidebars as $sidebar) {
			register_sidebar($sidebar);
		}
	}

	add_action('widgets_init', 'themeSidebars');
}

//////

if (!function_exists('set_posts_per_page')) {

	function set_posts_per_page($query) {
		if (isset($query->query_vars['list-about'])) {
			$query->query_vars['posts_per_archive_page'] = 6;
		}
	}

	add_action('parse_request', 'set_posts_per_page', 10, 1);
}

if (!function_exists('vicoders_generate_paginator_global_var')) {

	function vicoders_generate_paginator_global_var() {
		$args = [
			'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
		];
		echo '<nav class="pagination" aria-label="Page navigation">';
		echo paginate_links($args);
		echo '</nav>';
	}

	add_action('namtin_pagination_global', 'vicoders_generate_paginator_global_var', 10, 0);

}

//Pagination life post
if (!function_exists('set_posts_per_page_life')) {

	function set_posts_per_page_life($query) {
		if (isset($query->query_vars['list-life'])) {
			$query->query_vars['posts_per_archive_page'] = 6;
		}
	}

	add_action('parse_request', 'set_posts_per_page_life', 10, 1);
}

if (!function_exists('vicoders_generate_paginator_global_var_life')) {

	function vicoders_generate_paginator_global_var_life() {
		$args = [
			'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
		];
		echo '<nav class="pagination" aria-label="Page navigation">';
		echo paginate_links($args);
		echo '</nav>';
	}

	add_action('life_pagination_global', 'vicoders_generate_paginator_global_var', 10, 0);

}

//Pagination Study option post

if (!function_exists('set_posts_per_page_option')) {

	function set_posts_per_page_option($query) {
		if (isset($query->query_vars['list-option'])) {
			$query->query_vars['posts_per_archive_page'] = 6;
		}
	}

	add_action('parse_request', 'set_posts_per_page_option', 10, 1);
}

if (!function_exists('vicoders_generate_paginator_global_var_option')) {

	function vicoders_generate_paginator_global_var_option() {
		$args = [
			'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
		];
		echo '<nav class="pagination" aria-label="Page navigation">';
		echo paginate_links($args);
		echo '</nav>';
	}

	add_action('option_pagination_global', 'vicoders_generate_paginator_global_var', 10, 0);

}

//Pagination Diplomas post

if (!function_exists('set_posts_per_page_diplomas')) {

	function set_posts_per_page_diplomas($query) {
		if (isset($query->query_vars['list-diplomas'])) {
			$query->query_vars['posts_per_archive_page'] = 6;
		}
	}

	add_action('parse_request', 'set_posts_per_page_diplomas', 10, 1);
}

if (!function_exists('vicoders_generate_paginator_global_var_diplomas')) {

	function vicoders_generate_paginator_global_var_diplomas() {
		$args = [
			'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
		];
		echo '<nav class="pagination" aria-label="Page navigation">';
		echo paginate_links($args);
		echo '</nav>';
	}

	add_action('diplomas_pagination_global', 'vicoders_generate_paginator_global_var', 10, 0);

}

//Pagination Degrees post

if (!function_exists('set_posts_per_page_degrees')) {

	function set_posts_per_page_degrees($query) {
		if (isset($query->query_vars['list-degrees'])) {
			$query->query_vars['posts_per_archive_page'] = 6;
		}
	}

	add_action('parse_request', 'set_posts_per_page_degrees', 10, 1);
}

if (!function_exists('vicoders_generate_paginator_global_var_degrees')) {

	function vicoders_generate_paginator_global_var_degrees() {
		$args = [
			'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
		];
		echo '<nav class="pagination" aria-label="Page navigation">';
		echo paginate_links($args);
		echo '</nav>';
	}

	add_action('degrees_pagination_global', 'vicoders_generate_paginator_global_var', 10, 0);

}

//Pagination Graduate post

if (!function_exists('set_posts_per_page_graduate')) {

	function set_posts_per_page_graduate($query) {
		if (isset($query->query_vars['list-graduate'])) {
			$query->query_vars['posts_per_archive_page'] = 6;
		}
	}

	add_action('parse_request', 'set_posts_per_page_graduate', 10, 1);
}

if (!function_exists('vicoders_generate_paginator_global_var_graduate')) {

	function vicoders_generate_paginator_global_var_graduate() {
		$args = [
			'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
		];
		echo '<nav class="pagination" aria-label="Page navigation">';
		echo paginate_links($args);
		echo '</nav>';
	}

	add_action('graduate_pagination_global', 'vicoders_generate_paginator_global_var', 10, 0);

}

//Pagination International post

if (!function_exists('set_posts_per_page_nation')) {

	function set_posts_per_page_nation($query) {
		if (isset($query->query_vars['list-international'])) {
			$query->query_vars['posts_per_archive_page'] = 6;
		}
	}

	add_action('parse_request', 'set_posts_per_page_nation', 10, 1);
}

if (!function_exists('vicoders_generate_paginator_global_var_nation')) {

	function vicoders_generate_paginator_global_var_nation() {
		$args = [
			'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
		];
		echo '<nav class="pagination" aria-label="Page navigation">';
		echo paginate_links($args);
		echo '</nav>';
	}

	add_action('nation_pagination_global', 'vicoders_generate_paginator_global_var', 10, 0);

}

//Pagination Research post()
if (!function_exists('set_posts_per_page_research_page')) {

	function set_posts_per_page_research_page($query) {
		if (isset($query->query_vars['list-research'])) {
			$query->query_vars['posts_per_archive_page'] = 6;
		}
	}

	add_action('parse_request', 'set_posts_per_page_research_page', 10, 1);
}

if (!function_exists('vicoders_generate_paginator_global_var_research_page')) {

	function vicoders_generate_paginator_global_var_research_page() {
		$args = [
			'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
		];
		echo '<nav class="pagination" aria-label="Page navigation">';
		echo paginate_links($args);
		echo '</nav>';
	}

	add_action('research_page_pagination_global', 'vicoders_generate_paginator_global_var', 10, 0);

}

//Pagination Business
if (!function_exists('set_posts_per_page_business')) {

	function set_posts_per_page_business($query) {
		if (isset($query->query_vars['list-business'])) {
			$query->query_vars['posts_per_archive_page'] = 6;
		}
	}

	add_action('parse_request', 'set_posts_per_page_business', 10, 1);
}

if (!function_exists('vicoders_generate_paginator_global_var_business')) {

	function vicoders_generate_paginator_global_var_business() {
		$args = [
			'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
		];
		echo '<nav class="pagination" aria-label="Page navigation">';
		echo paginate_links($args);
		echo '</nav>';
	}

	add_action('business_page_pagination_global', 'vicoders_generate_paginator_global_var', 10, 0);

}
//Pagination Business
if (!function_exists('set_posts_per_page_admission')) {

	function set_posts_per_page_admission($query) {
		if (isset($query->query_vars['list-admission'])) {
			$query->query_vars['posts_per_archive_page'] = 6;
		}
	}

	add_action('parse_request', 'set_posts_per_page_admission', 10, 1);
}

if (!function_exists('vicoders_generate_paginator_global_var_admission')) {

	function vicoders_generate_paginator_global_var_admission() {
		$args = [
			'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
		];
		echo '<nav class="pagination" aria-label="Page navigation">';
		echo paginate_links($args);
		echo '</nav>';
	}

	add_action('admission_page_pagination_global', 'vicoders_generate_paginator_global_var', 10, 0);

}

if (!function_exists('vicoders_generate_paginator')) {

	function vicoders_generate_paginator($paged, $total) {
		$args = [
			'current' => $paged,
			'total' => $total,
			'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
		];
		echo '<nav class="pagination" aria-label="Page navigation">';
		echo paginate_links($args);
		echo '</nav>';
	}

	add_action('vicoders_pagination', 'vicoders_generate_paginator', 10, 2);

}

