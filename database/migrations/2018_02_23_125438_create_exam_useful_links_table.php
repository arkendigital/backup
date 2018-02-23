<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamUsefulLinksTable extends Migration {

	public function up()
	{
		Schema::create('exam_useful_links', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->text('link')->nullable();
			$table->tinyInteger('official')->index()->default(0);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('exam_useful_links');
	}
}
