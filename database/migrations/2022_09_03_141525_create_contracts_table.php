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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('day',10);
            $table->date('date');
            $table->string('image')->nullable();
            $table->text('terms')->nullable();
            $table->bigInteger('seller_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->decimal('cost')->unsigned()->default('0');
            $table->decimal('discount',8,2)->unsigned()->default('0');
            $table->decimal('total',8,2)->unsigned()->default('0');
            $table->decimal('tax',8,2)->unsigned()->default('0');
            $table->decimal('net_amount',8,2)->unsigned()->default('0');
            $table->string('payment_status')->default(true);
            $table->string('payment_method', 50);
            $table->text('notes')->nullable();
            $table->foreignId('project_id')->constrained('projects','id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('status', 50);
            $table->string('created_by',255);
            $table->softDeletes();
            $table->timestamps();
            // $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            // $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
};
