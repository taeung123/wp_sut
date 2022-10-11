<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class Degrees extends CustomPost {
	/**
	 * [$type description]
	 * @var string
	 */
	public $type = 'degrees';

	/**
	 * [$single description]
	 * @var string
	 */
	public $single = 'Degrees';

	/**
	 * [$plural description]
	 * @var string
	 */
	public $plural = 'Degrees';

	/**
	 * $args optional
	 * @var array
	 */
	public $args = ['menu_icon' => 'dashicons-dashboard'];

}
