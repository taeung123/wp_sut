<?php
namespace App\Taxonomies;

use App\Taxonomies\BaseTaxonomy as Tax;

class ListOptionTaxonomy extends Tax
{
    public function __construct()
    {
        $config = [
            'slug'   => 'list-option',
            'single' => 'List-Option',
            'plural' => 'List-Options'
        ];

        $postType = 'option';

        $args = [];

        parent::__construct($config, $postType, $args);
    }
}
