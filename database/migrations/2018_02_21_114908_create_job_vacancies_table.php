<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobVacanciesTable extends Migration {

	public function up()
	{
		Schema::create('job_vacancies', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('excerpt');
			$table->text('content');
			$table->decimal('salary');
			$table->integer('location_id')->index();
			$table->integer('company_id')->index();
			$table->text('apply_link');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('job_vacancies');
	}
}
