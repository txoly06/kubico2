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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //proprietario do imovel
            $table->string('title');
            $table->string('description');
            $table->decimal('price',15,2);
            $table->string('address');
            $table->string('type'); //aluguer, venda
            $table->string('status')->default('Disponivel');//disponivel, venda, aluguer
            $table->integer('quartos');
            $table->integer('banheiros'); //Nº de Banheiros
            $table->integer('area');
            $table->timestamps();

            //Chave estrangeira que faz referencia ao id na tabla users

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
