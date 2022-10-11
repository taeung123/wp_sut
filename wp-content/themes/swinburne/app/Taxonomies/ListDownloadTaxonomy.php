<?php
namespace App\Taxonomies;

use App\Taxonomies\BaseTaxonomy as Tax;

class ListDownloadTaxonomy extends Tax {
	public function __construct() {
		$config = [
			'slug' => 'list-download',
			'single' => 'List-Download',
			'plural' => 'List-Downloads',
		];

		$postType = 'download';

		$args = [];

		parent::__construct($config, $postType, $args);
	}
}
