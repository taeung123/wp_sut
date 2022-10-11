<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class Life extends CustomPost {
	/**
	 * [$type description]
	 * @var string
	 */
	public $type = 'life';

	/**
	 * [$single description]
	 * @var string
	 */
	public $single = 'Life';

	/**
	 * [$plural description]
	 * @var string
	 */
	public $plural = 'Life';

	/**
	 * $args optional
	 * @var array
	 */
	public $args = ['menu_icon' => 'dashicons-admin-customizer'];

}
