<?php

use App\Models\ProjectInspection;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ProjectInspection::class, 'inspection_id');
            $table->foreignIdFor(User::class, 'user_id')->nullable();
            $table->text('feedback')->nullable();
            $table->boolean('approved')->nullable();
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
        Schema::dropIfExists('inspection_approvals');
    }
}
