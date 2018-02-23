<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiscussionRepliesTable extends Migration {

	public function up()
	{
		Schema::create('discussion_replies', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('discussion_Id')->index();
			$table->integer('user_id')->index();
			$table->text('content');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('discussion_replies');
	}
}