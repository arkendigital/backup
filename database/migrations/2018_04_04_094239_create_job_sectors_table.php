<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_sectors', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
        });
        
        Schema::table('job_vacancies', function(Blueprint $table) {
            $table->unsignedInteger('sector_id')->nullable(true);
            $table->foreign('sector_id')->references('id')->on('job_sectors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_vacancies', function(Blueprint $table) {
            $table->dropForeign(['sector_id']);
            $table->dropColumn('sector_id');
        });

        Schema::dropIfExists('job_sectors');
    }
}
