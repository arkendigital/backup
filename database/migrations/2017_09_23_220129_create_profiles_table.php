<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unique()->unsigned()->index();
            $table->string('slug');
            $table->string('display_name');
            $table->string('user_title')->nullable();
            $table->string('location')->nullable();
            $table->string('gender')->nullable();
            $table->string('date_birth')->nullable();
            $table->string('avatar')->nullable();
            $table->string('signature')->nullable();
            $table->integer('post_count')->unsigned()->index()->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
