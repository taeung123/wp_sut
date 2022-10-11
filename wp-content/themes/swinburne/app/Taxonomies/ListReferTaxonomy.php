<?php
namespace App\Taxonomies;

use App\Taxonomies\BaseTaxonomy as Tax;

class ListReferTaxonomy extends Tax
{
    public function __construct()
    {
        $config = [
            'slug'   => 'list-refer',
            'single' => 'List-Refer',
            'plural' => 'List-Refers'
        ];

        $postType = 'refer';

        $args = [];

        parent::__construct($config, $postType, $args);
    }
}
