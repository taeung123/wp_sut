<?php
namespace App\Taxonomies;

use App\Taxonomies\BaseTaxonomy as Tax;

class ListInternationalTaxonomy extends Tax
{
    public function __construct()
    {
        $config = [
            'slug'   => 'list-international',
            'single' => 'List-International',
            'plural' => 'List-Internationals'
        ];

        $postType = 'international';

        $args = [];

        parent::__construct($config, $postType, $args);
    }
}
