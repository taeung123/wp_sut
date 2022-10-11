<?php
namespace App\Taxonomies;

use App\Taxonomies\BaseTaxonomy as Tax;

class ListResearchTaxonomy extends Tax
{
    public function __construct()
    {
        $config = [
            'slug'   => 'list-research',
            'single' => 'List-Research',
            'plural' => 'List-Researches'
        ];

        $postType = 'research';

        $args = [];

        parent::__construct($config, $postType, $args);
    }
}
