<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class Research extends CustomPost {
	/**
	 * [$type description]
	 * @var string
	 */
	public $type = 'research';

	/**
	 * [$single description]
	 * @var string
	 */
	public $single = 'Research';

	/**
	 * [$plural description]
	 * @var string
	 */
	public $plural = 'Research';

	/**
	 * $args optional
	 * @var array
	 */
	public $args = ['menu_icon' => 'dashicons-admin-network'];

}
