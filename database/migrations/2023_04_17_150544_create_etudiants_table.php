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
            $table->string("nomEtudiants", 255);
            $table->String("prenomEtudiants", 255)->nullable();
            $table->date("ddnEtudiants");
            $table->string("ldnEtudiants", 255);
            $table->string("sexe");
            $table->string("contactEtudiants");
            $table->string("emailEtudiants", 250);
            $table->string("adresseEtudiants", 250);
            $table->string("imageEtudidants", 250)->nullable();
            $table->string("numMatriculeMoto")->nullable();
            $table->string("documents");
            $table->string("codeBarre");
            $table->foreignId('Filieres_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Classes_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
