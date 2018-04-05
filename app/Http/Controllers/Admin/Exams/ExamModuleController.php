<?php

namespace App\Http\Controllers\Admin\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
* Load modules.
*
*/
use App\Models\Exam\Category as ExamCategory;
use App\Models\Exam\Module as ExamModule;
use App\Models\Exam\Info as ExamModuleInfo;

/**
* Load requests.
*
*/
use App\Http\Requests\ExamModule as ExamModuleRequest;

class ExamModuleController extends Controller
{

  /**
  * Show form for creating a new module.
  *
  */
    public function create()
    {

    /**
    * Get category.
    *
    */
        $category = ExamCategory::find($_GET["category_id"]);

        /**
        * Module sections.
        *
        */
        $module_sections = $this->getModuleSections();

        /**
        * Show page.
        *
        */
        return view("admin.exams.modules.create", compact(
      "category",
      "module_sections"
    ));
    }

    /**
    * Insert new module into the database.
    *
    * @param ExamModuleRequest $request
    *
    */
    public function store(ExamModuleRequest $request)
    {

    /**
    * Add module to database.
    *
    */
        $module = ExamModule::create([
      "category_id" => request()->category_id,
      "name" => request()->name,
      "slug" => strtolower(str_slug(request()->name)),
      "excerpt" => request()->excerpt
    ]);

        /**
        * Add info to database.
        *
        */
        $info = ExamModuleInfo::create([
      "module_id" => $module->id,
      "name" => request()->info_name,
      "section_one_title" => request()->section_one_title,
      "section_one_text" => request()->section_one_text,
      "section_one_link" => request()->section_one_link,
      "section_two_title" => request()->section_two_title,
      "section_two_text" => request()->section_two_text,
      "section_two_link" => request()->section_two_link,
      "section_three_title" => request()->section_three_title,
      "section_three_text" => request()->section_three_text,
      "section_three_link" => request()->section_three_link,
      "section_four_title" => request()->section_four_title,
      "section_four_text" => request()->section_four_text,
      "section_four_link" => request()->section_four_link
    ]);

        /**
        * Get exam category.
        *
        */
        $category = $module->category;

        /**
        * Redirect to category view.
        *
        */
        return redirect(route("exam-categories.edit", compact(
      "category"
    )));
    }

    /**
    * Show form for editing a module.
    *
    * @param ExamModule $module
    *
    */
    public function edit(ExamModule $module)
    {

    /**
    * Get category.
    *
    */
        $category = $module->category;

        /**
        * Module sections.
        *
        */
        $module_sections = $this->getModuleSections();

        /**
        * Show page.
        *
        */
        return view("admin.exams.modules.edit", compact(
      "module",
      "category",
      "module_sections"
    ));
    }

    /**
    * Update a specific module.
    *
    * @param ExamModule $module
    * @param ExamModuleRequest $request
    *
    */
    public function update(ExamModule $module, ExamModuleRequest $request)
    {

    /**
    * Update module in database.
    *
    */
        $module->update([
      "category_id" => request()->category_id,
      "name" => request()->name,
      "slug" => strtolower(str_slug(request()->name)),
      "excerpt" => request()->excerpt,
    ]);

        /**
        * Update module info.
        *
        */
        $module->info->update([
      "name" => request()->info_name,
      "section_one_title" => request()->section_one_title,
      "section_one_text" => request()->section_one_text,
      "section_one_link" => request()->section_one_link,
      "section_two_title" => request()->section_two_title,
      "section_two_text" => request()->section_two_text,
      "section_two_link" => request()->section_two_link,
      "section_three_title" => request()->section_three_title,
      "section_three_text" => request()->section_three_text,
      "section_three_link" => request()->section_three_link,
      "section_four_title" => request()->section_four_title,
      "section_four_text" => request()->section_four_text,
      "section_four_link" => request()->section_four_link
    ]);

        /**
        * Get exam category.
        *
        */
        $category = $module->category;

        /**
        * Redirect to category view.
        *
        */
        return redirect(route("exam-categories.edit", compact(
      "category"
    )));
    }

    /**
    * Get module sections for loop.
    *
    */
    private function getModuleSections()
    {
        return [
      "one",
      "two",
      "three",
      "four"
    ];
    }
}
