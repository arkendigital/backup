<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlidesTable extends Migration {

	public function up()
	{
		Schema::create('slides', function(Blueprint $table) {
			$table->increments('id');
			$table->string('slug')->index();
			$table->string('title')->nullable();
			$table->string('text')->nullable();
			$table->integer('order');
			$table->string('image_path')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('slides');
	}
}