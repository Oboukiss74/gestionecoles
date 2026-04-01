<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('parents', function (Blueprint $table) {
            // exemple : modifier les nom des colonnes existantes
            $table->renameColumn('nom', 'nom_parent');
            $table->renameColumn('prenom', 'prenom_parent');
            $table->renameColumn('telephone', 'telephone_parent');
            $table->renameColumn('email', 'email_parent');
            $table->renameColumn('profession', 'profession_parent');
            // ou ajouter un attribut
            // $table->string('identifiant')->after('id')->unique();
        });
    }

    public function down()
    {
        //
    }
};
