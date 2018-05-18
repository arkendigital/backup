<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('internal_marketing')->nullable()->index();
            $table->string('external_marketing')->nullable()->index();
            $table->string('arn')->nullable();
            $table->string('current_role')->nullable();
            $table->string('company_name')->nullable();
            $table->string('location')->nullable();
            $table->string('experience')->nullable();
            $table->string('email_token')->nullable();
            $table->string('api_token', 60)->unique();
            $table->tinyInteger('verified')->default(0);
            $table->tinyInteger('role_id')->nullable();
            $table->tinyInteger('banned')->default(0);
            $table->tinyInteger('disabled')->default(0);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
