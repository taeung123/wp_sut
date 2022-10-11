<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class About extends CustomPost {
	/**
	 * [$type description]
	 * @var string
	 */
	public $type = 'about';

	/**
	 * [$single description]
	 * @var string
	 */
	public $single = 'About';

	/**
	 * [$plural description]
	 * @var string
	 */
	public $plural = 'About';

	/**
	 * $args optional
	 * @var array
	 */
	public $args = ['menu_icon' => 'dashicons-smiley'];

}
