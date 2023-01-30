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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',30);
            $table->string('middle_name',30)->nullable();
            $table->string('last_name',30);
            $table->text('address')->nullable();
            $table->text('qualification')->nullable();
            $table->string('job',50)->nullable();
            $table->text('job_description')->nullable();
            $table->string('personal_id',14)->nullable();
            $table->char('gender')->default('m');
            $table->text('image')->nullable();
            $table->string('mobile',11)->unique();
            $table->date('dirth_date')->nullable();
            $table->double('salary', 8, 2)->default(0.00);
            $table->decimal('commission_percentage',8,2)->default(0.00);
            $table->date('join_date');
            $table->integer('rating')->default(0);
            $table->foreignId('section_id')->nullable()->constrained('sections','id')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users','id')->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('employees');
    }
};
