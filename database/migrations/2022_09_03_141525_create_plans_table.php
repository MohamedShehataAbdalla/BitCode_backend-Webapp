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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->boolean('default')->default(true);
            $table->decimal('price_day',8,2)->default(0.00);
            $table->decimal('discount_day',8,2)->default(0.00);
            $table->decimal('price_month',8,2)->default(0.00);
            $table->decimal('discount_month',8,2)->default(0.00);
            $table->decimal('price_year',8,2)->default(0.00);
            $table->decimal('discount_year',8,2)->default(0.00);
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
        Schema::dropIfExists('plans');
    }
};
