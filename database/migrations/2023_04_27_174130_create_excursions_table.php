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
        Schema::create('excursions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('type_id');
            $table->string('title');
            $table->json('discription');
            $table->string('cover_image');
            $table->json('gallery');
            $table->decimal('rating');
            $table->integer('hits')->default(0);
            $table->integer('duration');
            $table->unsignedInteger('price');
            $table->unsignedInteger('max_customers_count');
            $table->json('times_array');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('type_id')->references('id')->on('excursion_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excursions');
    }
};
