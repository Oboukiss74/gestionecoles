<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Eleves;
use FactoryMethod\EleveFactory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('nom_parent');
            $table->string('prenom_parent');
            $table->string('telephone_parent');
            $table->string('email_parent')->unique();
            $table->string('profession_parent');
            $table->string('residence_parent')->nullable();
            $table->string('lien_parente')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents');
    }

};
