<?php

use App\Models\ReportCheckItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportCheckItemAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_check_item_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ReportCheckItem::class, 'checkitem_id');
            $table->text('name');
            $table->text('url');
            $table->text('mimeType');
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
        Schema::dropIfExists('report_check_item_attachments');
    }
}
