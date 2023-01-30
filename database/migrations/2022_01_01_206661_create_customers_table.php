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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',30);
            $table->string('middle_name',30)->nullable();
            $table->string('last_name',30);
            $table->text('address')->nullable();
            $table->string('job',50)->nullable();
            $table->string('personal_id',14)->nullable();
            $table->char('gender')->default('m');
            $table->text('image')->nullable();
            $table->text('opinion')->nullable();
            $table->string('mobile',11)->unique();
            $table->date('dirth_date')->nullable();
            $table->integer('rating')->default(0);
            $table->boolean('special')->default(false);
            $table->foreignId('user_id')->nullable()->constrained('users','id')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('company_id')->nullable()->constrained('companies','id')->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('customers');
    }
};
