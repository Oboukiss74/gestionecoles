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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('parent_nom');
            $table->string('parent_prenom');
            $table->string('parent_telephone');
            $table->string('parent_email')->unique();
            $table->string('parent_profession');
            $table->string('lien_parente');
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
    // je veut une fonction pour modifier les attributs d'un parent
    public function modifierAttributsParent(): void
    {        Schema::table('parents', function (Blueprint $table) {
            $table->string('nom_parent')->after('nom');
            $table->string('prenom_parent')->after('prenom');
            $table->string('telephone_parent')->after('telephone');
            $table->string('profession_parent')->after('profession');
        });
    }
};
