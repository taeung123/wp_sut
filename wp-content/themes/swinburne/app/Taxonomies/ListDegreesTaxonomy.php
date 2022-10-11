<?php
namespace App\Taxonomies;

use App\Taxonomies\BaseTaxonomy as Tax;

class ListDegreesTaxonomy extends Tax
{
    public function __construct()
    {
        $config = [
            'slug'   => 'list-degrees',
            'single' => 'List-Degree',
            'plural' => 'List-Degrees'
        ];

        $postType = 'degrees';

        $args = [];

        parent::__construct($config, $postType, $args);
    }
}
