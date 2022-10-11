<?php
namespace App\Taxonomies;

use App\Taxonomies\BaseTaxonomy as Tax;

class ListLifeTaxonomy extends Tax
{
    public function __construct()
    {
        $config = [
            'slug'   => 'list-life',
            'single' => 'List-Life',
            'plural' => 'List-Lives'
        ];

        $postType = 'life';

        $args = [];

        parent::__construct($config, $postType, $args);
    }
}
