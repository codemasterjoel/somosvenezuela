<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Ramsey\Uuid\Uuid;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('militantes', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Uuid::uuid4()->toString());
            $table->boolean('estatus')->default(false);
            $table->Integer('cedula')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->date('fecha_nac');
            $table->string('telefono')->nullable();
            $table->string('correo');
            $table->Integer('edad');

            $table->boolean('vocero')->default(false);
            $table->boolean('pertenece_al_psuv')->default(false);
            $table->boolean('cargo_popular')->default(false);
            $table->string('cargo')->nullable();
            $table->foreignId('nivel_id')->nullable()->references('id')->on('nivels')->nullOnDelete()->cascadeOnUpdate();
            
            $table->foreignId('genero_id')->nullable()->references('id')->on('generos')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('nivel_academico_id')->nullable()->references('id')->on('nivel_academicos')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('profesion_id')->nullable()->references('id')->on('profesions')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('responsabilidad_id')->nullable()->references('id')->on('responsabilidads')->nullOnDelete()->cascadeOnUpdate();

            $table->foreignId('estado_id')->nullable()->references('id')->on('estados')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('municipio_id')->nullable()->references('id')->on('municipios')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('parroquia_id')->nullable()->references('id')->on('parroquias')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('comuna_id')->nullable()->references('id')->on('comunas')->nullOnDelete()->cascadeOnUpdate();
            $table->string('direccion', 200);
            
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('militantes');
    }
};
