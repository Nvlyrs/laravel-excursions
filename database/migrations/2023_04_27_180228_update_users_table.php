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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('user_group_id')->default(0);
            $table->string('surname')->nullable();
            $table->string('avatar_image')->nullable();
            $table->string('patronymic')->nullable();
            $table->string('phone_number')->nullable();

            $table->foreign('user_group_id')->references('id')->on('user_groups');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_group_id');
            $table->dropColumn('surname');
            $table->dropColumn('patronymic');
            $table->dropColumn('phone_number');
        });
    }
};
