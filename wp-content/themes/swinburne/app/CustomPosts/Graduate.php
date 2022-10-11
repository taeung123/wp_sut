<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class Graduate extends CustomPost {
	/**
	 * [$type description]
	 * @var string
	 */
	public $type = 'graduate';

	/**
	 * [$single description]
	 * @var string
	 */
	public $single = 'Graduate';

	/**
	 * [$plural description]
	 * @var string
	 */
	public $plural = 'Graduate';

	/**
	 * $args optional
	 * @var array
	 */
	public $args = ['menu_icon' => 'dashicons-book'];

}
