<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSalarySurveryTable extends Migration {

	public function up()
	{
		Schema::create('salary_survery', function(Blueprint $table) {
			$table->increments('id');
			$table->string('type')->index();
			$table->string('sector')->index();
			$table->string('field')->index();
			$table->string('experience')->index();
			$table->string('qualifications')->index();
			$table->decimal('annual_salary')->index();
			$table->integer('user_id')->nullable()->index();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('salary_survery');
	}
}