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
        if (! Schema::hasTable('annee_scolaires')) {
            Schema::create('annee_scolaires', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('libelle');       // "2024-2025"
                $table->boolean('active')->default(false);
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annee_scolaires');
    }
};
