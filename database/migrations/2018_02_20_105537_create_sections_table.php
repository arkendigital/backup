<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectionsTable extends Migration {

	public function up()
	{
		Schema::create('sections', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('slug')->index();
			$table->string('color', 6)->nullable();
			$table->string('image_path');
			$table->string('thumbnail_path');
			$table->integer('sidebar_id')->index()->nullable();
			$table->integer('order')->index()->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('sections');
	}
}
