<?php
namespace App\Taxonomies;

use App\Taxonomies\BaseTaxonomy as Tax;

class ListDiplomasTaxonomy extends Tax
{
    public function __construct()
    {
        $config = [
            'slug'   => 'list-diplomas',
            'single' => 'List-Diploma',
            'plural' => 'List-Diplomas'
        ];

        $postType = 'diplomas';

        $args = [];

        parent::__construct($config, $postType, $args);
    }
}
