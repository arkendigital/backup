<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCpdResourcesLinksTable extends Migration {

	public function up()
	{
		Schema::create('cpd_resources_links', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('resource_id')->index();
			$table->string('title');
			$table->string('subtitle');
			$table->string('text');
			$table->string('link');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cpd_resources_links');
	}
}
