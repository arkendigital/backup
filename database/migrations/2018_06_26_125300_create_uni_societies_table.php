<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUniSocietiesTable extends Migration {

	public function up()
	{
		Schema::create('uni_societies', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('link');
			$table->string('logo_path')->nullable(true);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('uni_societies');
	}
}
