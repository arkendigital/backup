<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvertsTable extends Migration {

	public function up()
	{
		Schema::create('adverts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->text('url')->nullable();
			$table->string('image_path')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('adverts');
	}
}
