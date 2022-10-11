<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class Business extends CustomPost {
	/**
	 * [$type description]
	 * @var string
	 */
	public $type = 'business';

	/**
	 * [$single description]
	 * @var string
	 */
	public $single = 'Business';

	/**
	 * [$plural description]
	 * @var string
	 */
	public $plural = 'Business';

	/**
	 * $args optional
	 * @var array
	 */
	public $args = ['menu_icon' => 'dashicons-store'];

}
