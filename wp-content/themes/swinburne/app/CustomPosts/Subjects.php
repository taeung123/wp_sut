<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class Subjects extends CustomPost
{
    /**
     * [$type description]
     * @var string
     */
    public $type = 'subjects';

    /**
     * [$single description]
     * @var string
     */
    public $single = 'Subjects';

    /**
     * [$plural description]
     * @var string
     */
    public $plural = 'Subjects';

    /**
     * $args optional
     * @var array
     */
    public $args = ['menu_icon' => 'dashicons-location-alt'];

}
