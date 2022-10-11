<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class Library extends CustomPost {
	/**
	 * [$type description]
	 * @var string
	 */
	public $type = 'library';

	/**
	 * [$single description]
	 * @var string
	 */
	public $single = 'Library';

	/**
	 * [$plural description]
	 * @var string
	 */
	public $plural = 'Library';

	/**
	 * $args optional
	 * @var array
	 */
	public $args = ['menu_icon' => 'dashicons-welcome-widgets-menus'];

}
