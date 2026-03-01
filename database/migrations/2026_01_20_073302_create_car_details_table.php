<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('car_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('car_id')
                ->constrained('cars')
                ->onDelete('cascade');

            $table->string('title');          // "Hyundai Tucson"
            $table->string('hero_image');     // image path

            $table->integer('rating')->default(0);   // 1–5

            $table->text('intro_text');

            $table->string('interior_image');
            $table->text('interior_text');

            $table->string('drive_image');
            $table->text('drive_text');

            $table->text('safety_text');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_details');
    }
};
