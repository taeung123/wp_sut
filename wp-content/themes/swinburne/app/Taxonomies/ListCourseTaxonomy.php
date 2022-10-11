<?php
namespace App\Taxonomies;

use App\Taxonomies\BaseTaxonomy as Tax;

class ListCourseTaxonomy extends Tax
{
    public function __construct()
    {
        $config = [
            'slug'   => 'list-course',
            'single' => 'List-Course',
            'plural' => 'List-Courses'
        ];

        $postType = 'course';

        $args = [];

        parent::__construct($config, $postType, $args);
    }
}
