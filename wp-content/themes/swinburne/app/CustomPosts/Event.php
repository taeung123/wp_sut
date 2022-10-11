<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class Event extends CustomPost {
	/**
	 * [$type description]
	 * @var string
	 */
	public $type = 'event';

	/**
	 * [$single description]
	 * @var string
	 */
	public $single = 'Event';

	/**
	 * [$plural description]
	 * @var string
	 */
	public $plural = 'Event';

	/**
	 * $args optional
	 * @var array
	 */
	public $args = ['menu_icon' => 'dashicons-admin-multisite'];

}
