<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesFieldsTable extends Migration {

	public function up()
	{
		Schema::create('pages_fields', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('page_id')->index();
			$table->string('type')->index();
			$table->string('name')->nullable();
			$table->string('key')->index();
			$table->text('value')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('pages_fields');
	}
}
