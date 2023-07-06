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
        Schema::create('Etudiants', function (Blueprint $table) {
            $table->id();
            $table->string("Nom_Etudiants", 255);
            $table->String("Prenom_Etudiants", 255)->nullable();
            $table->date("Ddn_Etudiants");
            $table->string("Ldn_Etudiants", 255);
            $table->string("Sexe");
            $table->string("Contact_Etudiants");
            $table->string("Email_Etudiants", 250);
            $table->string("Adresse_Etudiants", 250);
            $table->string("Image_Etudidants", 250)->nullable();
            $table->string("NumMatriculeMoto")->nullable();
            $table->string("Documents");
            $table->string("code_barre");
            $table->foreignId('Filieres_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Etudiants');
    }
};
