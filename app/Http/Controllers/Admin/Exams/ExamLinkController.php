<?php

namespace App\Http\Controllers\Admin\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\AWS\ImageController as AWS;

use App\Http\Requests\ExamLink as ExamLinkRequest;

use App\Models\ExamUsefulLink;

class ExamLinkController extends Controller {

  /**
  * Display list of useful links.
  *
  */
  public function index() {

    /**
    * Get official links.
    */
    $official_links = ExamUsefulLink::where("official", 1)
      ->get();

    /**
    * Get unofficial links.
    */
    $unofficial_links = ExamUsefulLink::where("official", 0)
      ->get();

    /**
    * Display results.
    */
    return view("admin.exams.links.index", compact(
      "official_links",
      "unofficial_links"
    ));

  }

  /**
  * Show form for creating a new useful link
  *
  */
  public function create() {

    return view("admin.exams.links.create");

  }

  /**
  * Create a new link in database storage.
  *
  * @param ExamLinkRequest $request
  *
  */
  public function store(ExamLinkRequest $request) {

    /**
    * Add into storage.
    */
    $link = ExamUsefulLink::create([
      "name" => request()->name,
      "link" => request()->link,
      "official" => request()->official
    ]);

    /**
    * Redirect to edit page.
    */
    return redirect(route("exam-links.edit", compact(
      "link"
    )));

  }

  /**
  * Show form for editing a link
  *
  * @param ExamUsefulLink $link
  *
  */
  public function edit(ExamUsefulLink $link) {

    return view("admin.exams.links.edit", compact(
      "link"
    ));

  }

  /**
  * Update specified link in database storage.
  *
  * @param ExamUsefulLink $link
  * @param ExamLinkRequest $request
  *
  */
  public function update(ExamUsefulLink $link, ExamLinkRequest $request) {

    /**
    * Update link in storage.
    */
    $link->update([
      "name" => request()->name,
      "link" => request()->link,
      "official" => request()->official
    ]);

    /**
    * Redirect to edit page.
    */
    return redirect()->back();

  }

}
