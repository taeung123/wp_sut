<?php
namespace App\Taxonomies;

use App\Taxonomies\BaseTaxonomy as Tax;

class ListAdmissionTaxonomy extends Tax
{
    public function __construct()
    {
        $config = [
            'slug'   => 'list-admission',
            'single' => 'List-Admission',
            'plural' => 'List-Admission'
        ];

        $postType = 'admission';

        $args = [];

        parent::__construct($config, $postType, $args);
    }
}
