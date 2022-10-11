<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class Option extends CustomPost {
	/**
	 * [$type description]
	 * @var string
	 */
	public $type = 'option';

	/**
	 * [$single description]
	 * @var string
	 */
	public $single = 'Option';

	/**
	 * [$plural description]
	 * @var string
	 */
	public $plural = 'Option';

	/**
	 * $args optional
	 * @var array
	 */
	public $args = ['menu_icon' => 'dashicons-admin-generic'];

}
