<?php

namespace App\Providers;

use App\CustomPosts\About;
use App\CustomPosts\Admission;
use App\CustomPosts\Business;
use App\CustomPosts\Course;
use App\CustomPosts\Degrees;
use App\CustomPosts\Diplomas;
use App\CustomPosts\Download;
use App\CustomPosts\Event;
use App\CustomPosts\Graduate;
use App\CustomPosts\International;
use App\CustomPosts\Life;
use App\CustomPosts\Library;
use App\CustomPosts\Option;
use App\CustomPosts\Research;
use App\CustomPosts\NewsType;
use App\CustomPosts\Student;
use App\CustomPosts\Subjects;
use App\CustomPosts\Refer;
use Illuminate\Support\ServiceProvider;

class CustomPostServiceProvider extends ServiceProvider {
	/**
	 * [$listen description]
	 * @var array
	 */
	public $listen = [
		NewsType::class,
		Event::class,
		About::class,
		Research::class,
		Business::class,
		Life::class,
		Option::class,
		Diplomas::class,
		Degrees::class,
		Graduate::class,
		International::class,
		Course::class,
		Admission::class,
		Subjects::class,
		Library::class,
		Student::class,
		Download::class,
		Refer::class,
	];

	/**
	 * [register description]
	 * @return [type] [description]
	 */
	public function register() {
		foreach ($this->listen as $class) {
			$this->resolveCustomPost($class);
		}
	}

	/**
	 * [resolveCustomPost description]
	 * @param  [type] $postType [description]
	 * @return [type]           [description]
	 */
	public function resolveCustomPost($postType) {
		return new $postType();
	}
}
