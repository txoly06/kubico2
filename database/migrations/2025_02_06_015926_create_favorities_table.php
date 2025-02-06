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
        Schema::create('favorities', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('property_id');
            $table->timestamps();

            // Chave primária composta
        $table->primary(['user_id', 'property_id']);

        // Chaves estrangeiras
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorities');
    }
};
