<?php
namespace App\Taxonomies;

use App\Taxonomies\BaseTaxonomy as Tax;

class ListStudentTaxonomy extends Tax {
	public function __construct() {
		$config = [
			'slug' => 'list-student',
			'single' => 'List-Student',
			'plural' => 'List-Students',
		];

		$postType = 'student';

		$args = [];

		parent::__construct($config, $postType, $args);
	}
}
