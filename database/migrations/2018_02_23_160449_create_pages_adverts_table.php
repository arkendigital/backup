<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesAdvertsTable extends Migration {

	public function up()
	{
		Schema::create('pages_adverts', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('page_id')->index();
			$table->integer('advert_id')->index();
			$table->string('slug')->index();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('pages_adverts');
	}
}
