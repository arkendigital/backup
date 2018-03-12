<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWidgetsTable extends Migration {

	public function up()
	{
		Schema::create('widgets', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('slug')->index();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('widgets');
	}
}