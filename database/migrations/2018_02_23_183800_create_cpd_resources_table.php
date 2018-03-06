<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCPDResourcesTable extends Migration {

	public function up()
	{
		Schema::create('cpd_resources', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('slug')->nullable();
			$table->string('excerpt')->nullable();
			$table->text('content')->nullable();
			$table->string('icon_path')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('cpd_resources');
	}
}
