<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->index();
            $table->string('author')->nullable();
            $table->longtext('body');
            $table->integer('user_id')->index();
            $table->string('image')->nullable();
            $table->enum('status', ['draft', 'publish', 'deleted'])->default('draft');
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
        Schema::dropIfExists('support_articles');
    }
}
