<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePageWidgetsTable extends Migration 
{

	public function up()
	{
		Schema::create('page_widgets', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('page_id')->index();
			$table->integer('widget_id')->index();
			$table->tinyInteger('visible')->default('1');
			$table->integer('order');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('page_widgets');
	}
}
