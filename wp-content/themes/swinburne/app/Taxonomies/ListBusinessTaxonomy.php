<?php
namespace App\Taxonomies;

use App\Taxonomies\BaseTaxonomy as Tax;

class ListBusinessTaxonomy extends Tax
{
    public function __construct()
    {
        $config = [
            'slug'   => 'list-business',
            'single' => 'List-Business',
            'plural' => 'List-Business'
        ];

        $postType = 'business';

        $args = [];

        parent::__construct($config, $postType, $args);
    }
}
