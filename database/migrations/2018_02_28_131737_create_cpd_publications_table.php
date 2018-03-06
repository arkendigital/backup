<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCpdPublicationsTable extends Migration {

	public function up()
	{
		Schema::create('cpd_publications', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('file_path');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('cpd_publications');
	}
}