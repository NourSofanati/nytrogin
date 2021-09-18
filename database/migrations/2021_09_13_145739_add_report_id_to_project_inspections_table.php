<?php

use App\Models\ProjectReport;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportIdToProjectInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_inspections', function (Blueprint $table) {
            $table->foreignIdFor(ProjectReport::class, 'report_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_inspections', function (Blueprint $table) {
            $table->dropcolumn('report_id');
        });
    }
}
