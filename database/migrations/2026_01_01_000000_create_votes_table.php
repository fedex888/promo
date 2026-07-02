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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->enum('side', ['frente', 'espalda']);
            $table->enum('type', ['like', 'dislike']);
            $table->string('voter_token', 36);
            $table->timestamps();

            // Un visitante (voter_token) solo puede votar una vez por lado.
            $table->unique(['side', 'voter_token']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
