<?php
namespace App\Taxonomies;

use App\Taxonomies\BaseTaxonomy as Tax;

class ListEventTaxonomy extends Tax
{
    public function __construct()
    {
        $config = [
            'slug'   => 'list-event',
            'single' => 'List-Event',
            'plural' => 'List-Events'
        ];

        $postType = 'event';

        $args = [];

        parent::__construct($config, $postType, $args);
    }
}
