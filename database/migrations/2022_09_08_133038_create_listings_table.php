<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            // Cascade - Ako je korisnik napravio nekoliko zapisa
            // I onda se tog korisnika obriše iz baze 
            // Onda će se i njegovi zapisi obrisati
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            //Može ostati string jer ne spremamo sliku nego samo put do nje (Path)
            $table->string('logo')->nullable();
            $table->string('tags');
            $table->string('company');
            $table->string('location');
            $table->string('email');
            $table->string('website');
            $table->longText('description');
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
        Schema::dropIfExists('listings');
    }
};
