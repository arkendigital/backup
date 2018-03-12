<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBoxItemsTable extends Migration {

	public function up()
	{
		Schema::create('box_items', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('group_id')->index();
			$table->string('title');
			$table->string('link')->nullable();
			$table->integer('order')->default(0);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('box_items');
	}
}
