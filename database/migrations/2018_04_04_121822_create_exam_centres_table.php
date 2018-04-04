<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamCentresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_centres', function (Blueprint $table) {
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_centres');
    }
}
