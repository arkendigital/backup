<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectionsFieldsTable extends Migration {

	public function up()
	{
		Schema::create('sections_fields', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('section_id')->index();
			$table->string('type')->index();
			$table->string('name')->nullable();
			$table->string('key')->index();
			$table->text('value')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('sections_fields');
	}
}
