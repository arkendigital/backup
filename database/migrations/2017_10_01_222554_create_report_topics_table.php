<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index();
            $table->integer('content_id');
            $table->enum('content_type', ['post', 'user', 'game', 'file', 'comment', 'other']);
            $table->integer('author_id');
            $table->integer('owner_id')->nullable();
            $table->enum('status', ['open', 'claimed', 'closed'])->default('open');
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
        Schema::dropIfExists('report_topics');
    }
}
