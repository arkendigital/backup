<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBoxGroupsTable extends Migration {

	public function up()
	{
		Schema::create('box_groups', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('text')->nullable();
			$table->string('widget_slug')->index();
			$table->string('image_path')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('box_groups');
	}
}
