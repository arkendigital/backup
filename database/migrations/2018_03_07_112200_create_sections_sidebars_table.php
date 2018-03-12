<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectionsSidebarsTable extends Migration {

	public function up()
	{
		Schema::create('sections_sidebars', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('slug')->index();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('sections_sidebars');
	}
}
