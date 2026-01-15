<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();

            // Datos del cliente
            $table->string('name');
            $table->string('phone', 30);
            $table->string('email', 191);

            // Datos de la calculadora
            $table->string('housing_type')->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->integer('area_m2')->nullable();
            $table->longText('geojson')->nullable(); // JSON como TEXTO
            $table->string('bill_monthly')->nullable();

            // Extra
            $table->string('ip')->nullable();
            $table->string('user_agent')->nullable();

            $table->timestamps();

            // Índices útiles
            $table->index('email');
            $table->index('phone');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
