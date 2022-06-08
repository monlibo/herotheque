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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->string('description');
            $table->json('fields')->nullable();
            $table->json('skills')->nullable();
            $table->json('languages')->nullable();
            $table->json('qualities')->nullable();
            $table->string('experience')->nullable();
            $table->string('department_address');
            $table->string('city_address');
            $table->string('driver_licence');
            $table->integer('number_position_offered');
            $table->json('education_levels')->nullable();
            $table->date('publication_date');
            $table->date('disability_date');
            $table->boolean('immediatly_availability');
            $table->boolean('published')->default(true);
            $table->integer('offerable_id');
            $table->string('offerable_type');
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
        Schema::dropIfExists('offers');
    }
};
