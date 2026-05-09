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
        Schema::create('encyclopedias', function (Blueprint $table) {
            $table->id();
            $table->string('feeling')->nullable();
            $table->text('description')->nullable();
            $table->string('category')->default('Reflektif');
            $table->string('banner')->nullable();
            $table->text('quote')->nullable();
            $table->longText('content')->nullable();
            $table->json('tips')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encyclopedias');
    }
};
