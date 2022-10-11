<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class Admission extends CustomPost {
	/**
	 * [$type description]
	 * @var string
	 */
	public $type = 'admission';

	/**
	 * [$single description]
	 * @var string
	 */
	public $single = 'Admission';

	/**
	 * [$plural description]
	 * @var string
	 */
	public $plural = 'Admission';

	/**
	 * $args optional
	 * @var array
	 */
	public $args = ['menu_icon' => 'dashicons-welcome-learn-more'];

}
