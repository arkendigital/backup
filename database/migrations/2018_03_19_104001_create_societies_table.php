<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSocietiesTable extends Migration {

	public function up()
	{
		Schema::create('societies', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('slug');
			$table->string('email')->nullable(true);
			$table->string('link')->nullable(true);
			$table->string('postcode', 22)->nullable(true);
			$table->string('latitude', 22)->nullable(true);
			$table->string('longitude', 22)->nullable(true);
			$table->string('city')->nullable(true);
			$table->string('logo_path')->nullable(true);			
			$table->string('image_path')->nullable(true);
			$table->text('description')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('societies');
	}
}
