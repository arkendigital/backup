<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToJobVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_vacancies', function (Blueprint $table) {
            $table->decimal("min_salary", 8, 2)->nullable()->index();
			$table->decimal("max_salary", 8, 2)->nullable()->index();
			$table->decimal("min_daily_salary", 8, 2)->nullable()->index();
			$table->decimal("max_daily_salary", 8, 2)->nullable()->index();
			$table->string("sectors")->nullable()->index();
			$table->decimal("price", 8, 2)->nullable()->index();
			$table->timestamp("start_date")->nullalbe()->index();
			$table->timestamp("end_date")->nullalbe()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_vacancies', function (Blueprint $table) {
            $table->dropColumn(['min_salary','max_salary','min_daily_salary','max_daily_salary','sectors','price','start_date','end_date']);
        });
    }
}
