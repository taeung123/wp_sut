<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class Refer extends CustomPost {
	/**
	 * [$type description]
	 * @var string
	 */
	public $type = 'refer';

	/**
	 * [$single description]
	 * @var string
	 */
	public $single = 'Refer';

	/**
	 * [$plural description]
	 * @var string
	 */
	public $plural = 'Refer';

	/**
	 * $args optional
	 * @var array
	 */
	public $args = ['menu_icon' => 'dashicons-admin-generic'];

}
