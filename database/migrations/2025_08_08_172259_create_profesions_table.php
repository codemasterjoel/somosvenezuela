<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profesions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('nivel_academico_id')->nullable()->references('id')->on('nivel_academicos')->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('profesions');
    }
};
