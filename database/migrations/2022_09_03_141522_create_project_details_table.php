<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_details', function (Blueprint $table) {
            $table->id();
            $table->text('brief')->nullable();
            $table->text('objectives')->nullable();
            $table->text('benefits')->nullable();
            $table->text('description')->nullable();
            $table->text('requirements')->nullable();
            $table->text('other')->nullable();
            $table->foreignId('project_id')->constrained('projects','id')->cascadeOnDelete();
            $table->integer('created_by')->unsigned();
            $table->boolean('status')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('project_details');
    }
};
