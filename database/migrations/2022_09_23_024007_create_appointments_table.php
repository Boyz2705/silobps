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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('pet_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('service_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('clinic_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('session_id')->onUpdate('cascade')->onDelete('cascade');
            $table->date('app_date');
            $table->string('detail');
            $table->string('status')->default('Appointment Scheduled');
            $table->integer('bill');
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
        Schema::dropIfExists('appointments');
    }
};
