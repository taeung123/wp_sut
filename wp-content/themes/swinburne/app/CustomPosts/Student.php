<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class Student extends CustomPost {
	/**
	 * [$type description]
	 * @var string
	 */
	public $type = 'student';

	/**
	 * [$single description]
	 * @var string
	 */
	public $single = 'Student';

	/**
	 * [$plural description]
	 * @var string
	 */
	public $plural = 'Student';

	/**
	 * $args optional
	 * @var array
	 */
	public $args = ['menu_icon' => 'dashicons-universal-access'];

}
