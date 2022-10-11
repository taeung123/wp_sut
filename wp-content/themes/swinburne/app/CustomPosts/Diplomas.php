<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class Diplomas extends CustomPost {
	/**
	 * [$type description]
	 * @var string
	 */
	public $type = 'diplomas';

	/**
	 * [$single description]
	 * @var string
	 */
	public $single = 'Diplomas';

	/**
	 * [$plural description]
	 * @var string
	 */
	public $plural = 'Diplomas';

	/**
	 * $args optional
	 * @var array
	 */
	public $args = ['menu_icon' => 'dashicons-admin-links'];

}
