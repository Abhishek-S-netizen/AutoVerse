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
        Schema::create('car_highlights', function (Blueprint $table) {
            $table->id();

            $table->foreignId('car_id')
                ->constrained('cars')
                ->cascadeOnDelete()
                ->unique();

            $table->string('pro_1')->nullable();
            $table->string('pro_2')->nullable();
            $table->string('pro_3')->nullable();

            $table->string('con_1')->nullable();
            $table->string('con_2')->nullable();
            $table->string('con_3')->nullable();

            $table->string('best_for')->nullable();
            $table->text('key_features')->nullable();

            $table->string('image_path')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_highlights');
    }
};
