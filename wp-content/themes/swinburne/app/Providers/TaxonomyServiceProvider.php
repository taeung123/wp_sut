<?php

namespace App\Providers;

use App\Taxonomies\SampleTaxonomy;
use Illuminate\Support\ServiceProvider;

class TaxonomyServiceProvider extends ServiceProvider {
	public $listen = [
		SampleTaxonomy::class,
		\App\Taxonomies\ListAboutTaxonomy::class,
		\App\Taxonomies\ListResearchTaxonomy::class,
		\App\Taxonomies\ListEventTaxonomy::class,
		\App\Taxonomies\ListLifeTaxonomy::class,
		\App\Taxonomies\ListOptionTaxonomy::class,
		\App\Taxonomies\ListDiplomasTaxonomy::class,
		\App\Taxonomies\ListDegreesTaxonomy::class,
		\App\Taxonomies\ListGraduateTaxonomy::class,
		\App\Taxonomies\ListInternationalTaxonomy::class,
		\App\Taxonomies\ListCourseTaxonomy::class,
		\App\Taxonomies\ListBusinessTaxonomy::class,
		\App\Taxonomies\ListAdmissionTaxonomy::class,
		\App\Taxonomies\ListStudentTaxonomy::class,
		\App\Taxonomies\ListNewsTaxonomy::class,
		\App\Taxonomies\ListReferTaxonomy::class,
		\App\Taxonomies\ListDownloadTaxonomy::class,
	];

	public function register() {
		foreach ($this->listen as $class) {
			$this->resolveShortCode($class);
		}
	}

	/**
	 * Resolve a short_code instance from the class name.
	 *
	 * @param  string  $short_code
	 * @return short_code instance
	 */
	public function resolveShortCode($short_code) {
		return new $short_code();
	}
}
