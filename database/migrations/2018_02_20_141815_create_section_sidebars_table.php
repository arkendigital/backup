<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectionSidebarsTable extends Migration {

	public function up()
	{
		Schema::create('section_sidebars', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('section_id')->index();
			$table->integer('page_id')->index();
		});
	}

	public function down()
	{
		Schema::drop('section_sidebars');
	}
}