<?php
namespace App\Taxonomies;

use App\Taxonomies\BaseTaxonomy as Tax;

class ListGraduateTaxonomy extends Tax
{
    public function __construct()
    {
        $config = [
            'slug'   => 'list-graduate',
            'single' => 'List-Graduate',
            'plural' => 'List-Graduates'
        ];

        $postType = 'graduate';

        $args = [];

        parent::__construct($config, $postType, $args);
    }
}
