<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectionsSidebarsItemsTable extends Migration {

	public function up()
	{
		Schema::create('sections_sidebars_items', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('page_id')->index();
			$table->integer('sidebar_id')->index();
			$table->string('link_text');
			$table->string('url');
			$table->integer('order');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('sections_sidebars_items');
	}
}
