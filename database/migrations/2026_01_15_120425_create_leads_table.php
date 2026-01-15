<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('leads', function (Blueprint $table) {
      $table->id();

      // Datos cliente
      $table->string('name');
      $table->string('phone');
      $table->string('email');

      // Datos calculadora
      $table->string('housing_type')->nullable();
      $table->decimal('lat', 10, 7)->nullable();
      $table->decimal('lng', 10, 7)->nullable();
      $table->integer('area_m2')->nullable();
      $table->longText('geojson')->nullable();
      $table->string('bill_monthly')->nullable();

      // Extra opcional (por si quieres guardar “raw”)
      $table->string('ip')->nullable();
      $table->string('user_agent')->nullable();

      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('leads');
  }
};
