<?php

use App\Models\ProjectInspection;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //    protected $fillable = ['user_id', 'project_id', 'url', 'filename'];
        Schema::create('inspection_media', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreignIdFor(ProjectInspection::class, 'inspection_id');
            $table->text('url');
            $table->text('filename');
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
        Schema::dropIfExists('inspection_media');
    }
}
