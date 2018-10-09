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

    /**
     * Sitemap index
     * 
     * @return Illuminate\Http\Response
     */
	public function index()
	{
        $this->seo()->setTitle('XML Sitemap');
        \Debugbar::disable(); 

        $pagePages = ceil(Page::count() / 10000);
        $jobPages = ceil(Job::count() / 10000);
        $discussionPages = ceil(Discussion::count() / 10000);
        $examPages = ceil(ExamCategory::count() / 10000);

        $page = Page::latest('updated_at')->first();
        $job = Job::latest('updated_at')->first();
        $discussion = Discussion::latest('updated_at')->first();
        $examCategory = ExamCategory::latest('updated_at')->first();

        return response()->view('sitemap.index', compact([
            'pagePages', 'jobPages', 'discussionPages', 'examPages', 'page', 'job', 'discussion', 'examCategory'
        ]))->header('Content-Type', 'text/xml');
	}

    /**
     * Sitemap for Pages
     * 
     * @return \Illuminate\Http\Response
     */
    public function pages($page = null) 
    {
        $pages = cache()->remember('sitemap-pages-page-'.$page, now()->addDays(1), function () use ($page) {
            $offset = $page * 10000;

            return Page::select('id', 'slug', 'updated_at')
                                ->where('show_on_sitemap', 1)
                                ->orderBy('updated_at', 'desc')
                                ->take(10000)
                                ->offset($offset)
                                ->get();
        });

        return response()->view('sitemap.pages', [
            'pages' => $pages,
        ])->header('Content-Type', 'text/xml');   
    }

    /**
     * Sitemap for Jobs
     * 
     * @return \Illuminate\Http\Response
     */
    public function jobs($page = null) 
    {
        $jobs = cache()->remember('sitemap-jobs-page-'.$page, now()->addDays(1), function () use ($page) {
            $offset = $page * 10000;

            return Job::select('id', 'slug', 'updated_at')
                                ->orderBy('updated_at', 'desc')
                                ->take(10000)
                                ->offset($offset)
                                ->get();
        });

        return response()->view('sitemap.jobs', [
            'jobs' => $jobs,
        ])->header('Content-Type', 'text/xml');   
    }

    /**
     * Sitemap for Discussions
     * 
     * @return \Illuminate\Http\Response
     */
    public function discussions($page = null) 
    {
        $discussions = cache()->remember('sitemap-discussions-page-'.$page, now()->addDays(1), function () use ($page) {
            $offset = $page * 10000;

            return Discussion::orderBy('updated_at', 'desc')
                                ->take(10000)
                                ->offset($offset)
                                ->get();
        });

        return response()->view('sitemap.discussions', [
            'discussions' => $discussions,
        ])->header('Content-Type', 'text/xml');   
    }

    /**
     * Sitemap for Exam Categories
     * 
     * @return \Illuminate\Http\Response
     */
    public function examCategories($page = null) 
    {
        $examCategories = cache()->remember('sitemap-exam-categories-page-'.$page, now()->addDays(1), function () use ($page) {
            $offset = $page * 10000;

            return ExamCategory::orderBy('updated_at', 'desc')
                                ->take(10000)
                                ->offset($offset)
                                ->get();
        });

        return response()->view('sitemap.exam-categories', [
            'examCategories' => $examCategories,
        ])->header('Content-Type', 'text/xml');   
    }

}
