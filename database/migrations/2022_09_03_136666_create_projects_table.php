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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            // $table->text('features')->nullable();
            // $table->text('tools_used')->nullable();
            $table->text('client')->nullable();
            $table->text('url')->nullable();
            $table->decimal('price',8,2)->default(0.00);
            // $table->decimal('discount',8,2)->default(0.00);
            $table->foreignId('category_id')->constrained('categories','id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('service_id')->constrained('services','id')->cascadeOnUpdate()->restrictOnDelete();
            $table->integer('rating')->default(0);
            $table->string('version')->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('publish_date')->nullable();
            $table->boolean('publish_status')->default(false);
            // $table->integer('work_hours')->nullable();
            // $table->integer('work_days')->nullable();
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
        Schema::dropIfExists('projects');
    }
};
