<?php
namespace App\Taxonomies;

use App\Taxonomies\BaseTaxonomy as Tax;

class ListAboutTaxonomy extends Tax
{
    public function __construct()
    {
        $config = [
            'slug'   => 'list-about',
            'single' => 'List-About',
            'plural' => 'List-Abouts'
        ];

        $postType = 'about';

        $args = [];

        parent::__construct($config, $postType, $args);
    }
}
