<?php
/**
 * Sample class for a custom post type
 *
 */

namespace App\CustomPosts;

use NF\Abstracts\CustomPost;

class NewsType extends CustomPost
{
    /**
     * [$type description]
     * @var string
     */
    public $type = 'news';

    /**
     * [$single description]
     * @var string
     */
    public $single = 'News';

    /**
     * [$plural description]
     * @var string
     */
    public $plural = 'News';

    /**
     * $args optional
     * @var array
     */
    public $args = ['menu_icon' => 'dashicons-location-alt'];

}
