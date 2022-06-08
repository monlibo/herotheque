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
        Schema::create('profile_internships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained();
            $table->string('company');
            $table->integer('duration');
            $table->string('duration_type');
            $table->string('type');
            $table->longText('acquired')->nullable();
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
        Schema::dropIfExists('profile_internships');
    }
};
