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
        Schema::create('user_with_models', function (Blueprint $table) {
            $table->id();
            $table->integer('userid_n1')->nullable();
            $table->integer('userid_n2')->nullable();
            $table->boolean('like_n1')->nullable();
            $table->boolean('like_n2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_with_models');
    }
};
