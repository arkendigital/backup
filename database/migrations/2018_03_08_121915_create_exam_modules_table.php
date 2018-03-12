<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamModulesTable extends Migration {

	public function up()
	{
		Schema::create('exam_modules', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id')->index();
			$table->string('name');
			$table->string('slug')->index();
			$table->string('excerpt')->nullable();
			$table->text('description')->nullable();
			$table->integer('order')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('exam_modules');
	}
}
