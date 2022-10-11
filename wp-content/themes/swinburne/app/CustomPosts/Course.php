<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class Course extends CustomPost {
	/**
	 * [$type description]
	 * @var string
	 */
	public $type = 'course';

	/**
	 * [$single description]
	 * @var string
	 */
	public $single = 'Course';

	/**
	 * [$plural description]
	 * @var string
	 */
	public $plural = 'Course';

	/**
	 * $args optional
	 * @var array
	 */
	public $args = ['menu_icon' => 'dashicons-awards'];

}
