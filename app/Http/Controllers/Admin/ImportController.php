<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam\Module as ExamModule;
use App\Models\Survey;
use App\Models\SalarySurvey;
// use Excel;
use Maatwebsite\Excel\Facades\Excel;


class ImportController extends Controller
{

	public function exam()
	{

		return view("admin.import.exam");

	}

	public function examImport(Request $request)
	{

		$path = $request->file('file')->getRealPath();
		$data = Excel::load($path, function($reader) {})->get();

		if(!empty($data) && $data->count()){

			foreach ($data as $key => $value) {

				if (isset($value["module"]) && $value["module"] != "" && isset($value["difficulty"]) && $value["difficulty"] != "") {

					$module = ExamModule::where("slug", strtolower($value["module"]))
						->first();

					$insert = Survey::create([
						"module_id" => $module->id,
						"difficulty" => strtolower($value["difficulty"]),
						"created_at" => $value["created_at"]
					]);

				}

			}

		}

		alert("Import complete")
			->persistent();

		return redirect()->back();

	}



	public function salaryImport(Request $request)
	{

		$path = $request->file('file')->getRealPath();
		$data = Excel::load($path, function($reader) {})->get();

		if(!empty($data) && $data->count()){

			foreach ($data as $key => $value) {

				$insert = SalarySurvey::create([
					"type" => $value["type"],
					"sector" => $value["sector"],
					"field" => $value["field"],
					"experience" => $value["experience"],
					"qualifications" => $value["qualifications"],
					"annual_salary" => $value["annual_salary"],
					"daily_salary" => $value["daily_salary"],
					"user_id" => $value["user_id"],
					"created_at" => $value["created_at"]
				]);

			}

		}

		alert("Import complete")
			->persistent();

		return redirect()->back();

	}

	public function salary()
	{

		return view("admin.import.salary");

	}

}
