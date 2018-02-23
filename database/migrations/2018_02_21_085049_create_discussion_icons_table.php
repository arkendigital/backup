<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiscussionIconsTable extends Migration {

	public function up()
	{
		Schema::create('discussion_icons', function(Blueprint $table) {
			$table->increments('id');
			$table->string('icon');
		});
	}

	public function down()
	{
		Schema::drop('discussion_icons');
	}
}