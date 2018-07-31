<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
		$data = Excel::load($path, function($reader) {
					})->get();
					if(!empty($data) && $data->count()){
						foreach ($data as $key => $value) {
							print_r($value);
							echo "<br><br>";
							// $insert[] = ['title' => $value->title, 'description' => $value->description];
						}
						if(!empty($insert)){
							// print_r($insert);
							// echo "<br><br>";
							// DB::table('items')->insert($insert);
							// dd('Insert Record successfully.');
						}
					}
					die();

			$path = $request->file('file')->getRealPath();

			$data = Excel::load($path, function($reader) {})->get();


			if(!empty($data) && $data->count()){

				dd($data->all());

				foreach ($data->toArray() as $key => $value) {

					print_r($key);
					print_r($value);
					echo "<br><br>";

					if(!empty($value)){

						foreach ($value as $v) {

							// print_r($v);

							// $insert[] = ['title' => $v['title'], 'description' => $v['description']];

						}

					}

				}

			}

			// $data = Excel::load($path, function($reader) {
			// })->get();
			// if(!empty($data) && $data->count()){
			// 	dd($data);
			// 	foreach ($data as $key => $value) {
			// 		dd($key . " - " . $value . "");
			// 		$insert[] = ['title' => $value->title, 'description' => $value->description];
			// 	}
			// 	// if(!empty($insert)){
			// 		// DB::table('items')->insert($insert);
			// 		// dd('Insert Record successfully.');
			// 	// }
			// }
	}

	public function salary()
	{

		return (new SalarySurvey)->download('salary_survey_raw_data.xlsx');

		return redirect()->back();

	}

}
