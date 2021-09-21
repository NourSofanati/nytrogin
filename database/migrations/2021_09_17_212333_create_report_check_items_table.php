<?php

use App\Models\ReportChecklist;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportCheckItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_check_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ReportChecklist::class, 'checklist_id');
            $table->text('inspection');
            $table->enum('check', ['NO', 'YES', 'NA']);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('report_check_items');
    }
}
