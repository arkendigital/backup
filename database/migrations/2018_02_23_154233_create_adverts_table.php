<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvertsTable extends Migration {

	public function up()
	{
		Schema::create('adverts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->text('url')->nullable();
			$table->string('image_path')->nullable();
			$table->string('type')->nullable();
			$table->decimal('tenancy_price', 8, 2)->nullable();
			$table->decimal('cpc', 8, 2)->nullable();
			$table->timestamp('start_date')->nullable();
			$table->timestamp('end_date')->nullable();
			$table->tinyInteger('active')->default(1);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('adverts');
	}
}
