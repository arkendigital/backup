<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamModulesInfoTable extends Migration {

	public function up()
	{
		Schema::create('exam_modules_info', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('module_id')->index();
			$table->string('name')->nullable();
			$table->string('section_one_title')->nullable();
			$table->string('section_one_text')->nullable();
			$table->string('section_one_link')->nullable();
			$table->string('section_two_title')->nullable();
			$table->string('section_two_text')->nullable();
			$table->string('section_two_link')->nullable();
			$table->string('section_three_title')->nullable();
			$table->string('section_three_text')->nullable();
			$table->string('section_three_link')->nullable();
			$table->string('section_four_title')->nullable();
			$table->string('section_four_text')->nullable();
			$table->string('section_four_link')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('exam_modules_info');
	}
}
