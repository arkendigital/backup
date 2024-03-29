<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UrlMenusLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_menu_links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->string('link');
            $table->string('order');
            $table->unsignedInteger('url_menu_id')->nullable(true);
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
        Schema::dropIfExists("url_menu_links");
    }
}
