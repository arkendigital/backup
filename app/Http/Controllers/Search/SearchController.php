<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Page;
use App\Models\Exam\Category as ExamCategory;
use App\Models\Discussion;


class SearchController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'q' => 'required'
        ]);
        
        $results = new \stdClass();
        $results->pages = $this->findPages($request->q);
        $results->jobs = $this->findJobs($request->q);
        $results->exams = $this->findExams($request->q);
        $results->discussions = $this->findDiscussions($request->q);

        return view('search.index')->with(compact('results'));
    }
    
    private function findPages($query)
    {
        return Page::whereHas('fields', function ($q) use ($query) {
            $q->where('key', 'page_content')
              ->where('value', 'LIKE', '%' . $query . '%');
        })->orWhere('name', 'LIKE', '%' . $query . '%')
            ->latest()
            ->take(6)
            ->get();
    }

    private function findJobs($query)
    {
        return Job::where('title', 'LIKE', '%' . $query . '%')
            ->orWhere('content', 'LIKE', '%' . $query . '%')
            ->orWhere('excerpt', 'LIKE', '%' . $query . '%')
            ->latest()
            ->take(6)
            ->get();
    }

    private function findExams($query)
    {
        return ExamCategory::with('modules')
            ->where('name', 'LIKE', '%' . $query . '%')
            ->orWhereHas('modules', function ($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%');
            })
            ->latest()
            ->take(6)
            ->get();
    }

    private function findDiscussions($query)
    {
        return Discussion::with('category')
            ->where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('subject', 'LIKE', '%' . $query . '%')
            ->orWhere('excerpt', 'LIKE', '%' . $query . '%')
            ->orWhere('content', 'LIKE', '%' . $query . '%')
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%');
            })
            ->latest()
            ->take(6)
            ->get();
    }
}
