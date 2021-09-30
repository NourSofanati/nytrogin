<?php

use App\Models\ProjectChecklist;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_items', function (Blueprint $table) {
            $table->id();
            $table->text('inspection_item');
            $table->foreignIdFor(ProjectChecklist::class, 'checklist_id');
            $table->enum('status', ['YES', 'NO', 'N/A'])->nullable();
            $table->text('comment')->nullable();
            $table->text('action_needed')->nullable();
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
        Schema::dropIfExists('check_items');
    }
}
