<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('Nom', 20);
            $table->string('Prenom', 20);
            $table->foreignId('filiere_id')->constrained();
            $table->string('Section');
            $table->integer('Apogee');
            $table->string('CNE');
            $table->string('CIN');
            $table->date('date_naissance')->nullable();
            $table->foreignId('examen_ville_id')->nullable();
            $table->string('email')->unique();
            $table->boolean('Etat')->default(false);
            $table->timestamp('confirmation_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etudiants');
    }
}
