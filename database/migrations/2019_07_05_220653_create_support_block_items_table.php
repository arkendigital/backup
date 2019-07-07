<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportBlockItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_block_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('subtitle');
            $table->string('image');
            $table->unsignedInteger('support_block_id')->nullable(true);
            $table->foreign('support_block_id')->references('id')->on('support_blocks');
            $table->unsignedInteger('support_artilce_id')->nullable(true);
            $table->foreign('support_artilce_id')->references('id')->on('support_articles');
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
        Schema::dropIfExists('support_block_items');
    }
}
