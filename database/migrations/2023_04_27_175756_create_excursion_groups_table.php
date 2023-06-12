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
        Schema::create('excursion_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('excursion_id');
            $table->timestamp('date');
            $table->time('time');
            $table->timestamps();

            $table->foreign('excursion_id')->references('id')->on('excursions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excursion_groups');
    }
};
