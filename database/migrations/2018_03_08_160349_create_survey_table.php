<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSurveyTable extends Migration {

	public function up()
	{
		Schema::create('survey', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('module_id')->index();
			$table->string('difficulty')->index();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('survey');
	}
}