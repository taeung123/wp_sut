<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class International extends CustomPost {
	/**
	 * [$type description]
	 * @var string
	 */
	public $type = 'international';

	/**
	 * [$single description]
	 * @var string
	 */
	public $single = 'International';

	/**
	 * [$plural description]
	 * @var string
	 */
	public $plural = 'International';

	/**
	 * $args optional
	 * @var array
	 */
	public $args = ['menu_icon' => 'dashicons-admin-site'];

}
