<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class Download extends CustomPost {
	/**
	 * [$type description]
	 * @var string
	 */
	public $type = 'download';

	/**
	 * [$single description]
	 * @var string
	 */
	public $single = 'Download';

	/**
	 * [$plural description]
	 * @var string
	 */
	public $plural = 'Download';

	/**
	 * $args optional
	 * @var array
	 */
	public $args = ['menu_icon' => 'dashicons-welcome-learn-more'];

}
