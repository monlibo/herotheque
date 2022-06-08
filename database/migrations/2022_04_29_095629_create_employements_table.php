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
        Schema::create('employements', function (Blueprint $table) {
            $table->id();
            $table->string('offered_position');
            $table->string('type_of_contract');
            $table->bigInteger('min_salary')->nullable();
            $table->bigInteger('max_salary')->nullable();
            $table->string('payment_frequency');
            $table->integer('working_hours_per_week');
            $table->json('trainings')->nullable();
            $table->boolean('submit_resume');
            $table->boolean('submit_letter');
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
        Schema::dropIfExists('employements');
    }
};
