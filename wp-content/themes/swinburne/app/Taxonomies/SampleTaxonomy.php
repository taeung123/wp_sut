<?php

namespace App\Taxonomies;

use App\Taxonomies\BaseTaxonomy as Tax;

class SampleTaxonomy extends Tax
{
	public function __construct()
	{
		$config = [
			'slug' => 'sample_tax',
			'single' => 'Sample Tax',
			'plural' => 'Sample Tax'
		];

		$postType = 'post';

		$args = [

		];

		parent::__construct($config, $postType, $args);
	}
}