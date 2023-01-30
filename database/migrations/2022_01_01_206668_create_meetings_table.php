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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('time');
            $table->integer('duration')->default('0');
            $table->text('details')->nullable();
            // $table->foreignId('employee_id')->nullable()->constrained('employees','id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained('customers','id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('appointment_id')->nullable()->constrained('appointments','id')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('request_id')->nullable()->constrained('requests','id')->cascadeOnUpdate()->restrictOnDelete();
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
        Schema::dropIfExists('meetings');
    }
};
