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
        Schema::create('tests_data', function (Blueprint $table) {
            $table->id();
            $table->json('result');
            $table->foreignId('test_id')->constrained();
            $table->foreignId('user_id')->constrained()->comment('Doctor ID');
            $table->foreignId('patient_id')->constrained()->comment('Patient ID');
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
        Schema::dropIfExists('tests_data');
    }
};
