<?php
namespace App\Taxonomies;

use App\Taxonomies\BaseTaxonomy as Tax;

class ListNewsTaxonomy extends Tax
{
    public function __construct()
    {
        $config = [
            'slug'   => 'list-news',
            'single' => 'List-News',
            'plural' => 'List-News'
        ];

        $postType = 'news';

        $args = [];

        parent::__construct($config, $postType, $args);
    }
}
