<?php

namespace App\Http\Controllers\Sitemap;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Job;
use App\Models\Discussion;
use App\Models\Exam\Category as ExamCategory;

class SitemapController extends Controller
{

	public function index()
	{

		/**
		 * Get XML lists
		 *
		 */
		$pages = Page::all();
		$jobs = Job::all();
		$discussions = Discussion::all();
		$exam_categories = ExamCategory::all();

		$contents = \View::make("sitemap")->with("pages", $pages)->with("jobs", $jobs)->with("discussions", $discussions)->with("exam_categories", $exam_categories);
		$response = \Response::make($contents, 200);
		$response->header('Content-Type', 'application/xml');
		
		return $response;

	}

}
