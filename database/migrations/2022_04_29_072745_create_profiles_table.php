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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->longText('short_bio')->nullable();
            $table->longText('bio')->nullable();
            $table->json('skills')->nullable();
            $table->string('education_level')->nullable();
            $table->string('experience_years')->nullable();
            $table->json('fields')->nullable();
            $table->json('qualities')->nullable();
            $table->string('driver_licence')->nullable();
            $table->json('languages')->nullable();
            $table->longText('complementary_info')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('github')->nullable();
            $table->string('whatsapp')->nullable();
            $table->boolean('visibility')->default(true);
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
        Schema::dropIfExists('profiles');
    }
};
