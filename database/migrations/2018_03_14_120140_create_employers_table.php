<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployersTable extends Migration {

	public function up()
	{
		Schema::create('employers', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('slug')->index();
			$table->string('link')->nullable();
			$table->string('email')->nullable();
			$table->string('logo_path')->nullable();
			$table->integer('sector_id')->index();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('employers');
	}
}
