<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('location_id');
            $table->enum('category', ['Rumah Sakit', 'Apotek', 'Klinik', 'Praktek']);
            $table->text('description');
            $table->text('address');
            $table->string('phone_number');
            $table->string('website')->nullable();
            $table->float('longitude');
            $table->float('latitude');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('location_id')->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
