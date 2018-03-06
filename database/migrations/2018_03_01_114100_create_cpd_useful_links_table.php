<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCPDUsefulLinksTable extends Migration {

	public function up()
	{
		Schema::create('cpd_useful_links', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->text('link')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('cpd_useful_links');
	}
}
