<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewTabToSectionsSidebarsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sections_sidebars_items', function (Blueprint $table) {
            $table->tinyInteger("new_tab")->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sections_sidebars_items', function (Blueprint $table) {
            $table->dropColumn(['new_tab']);
        });
    }
}
