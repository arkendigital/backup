<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamResourcesTable extends Migration {

	public function up()
	{
		Schema::create('exam_resources', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('slug')->nullable();
			$table->string('excerpt')->nullable();
			$table->text('content')->nullable();
			$table->string('icon_path')->nullable();
			$table->integer('advert_id');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('exam_resources');
	}
}
