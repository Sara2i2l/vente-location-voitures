<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('marque');
        $table->string('modele');
        $table->year('annee');
        $table->decimal('prix', 10, 2);
        $table->enum('type', ['vente', 'location']);
        $table->boolean('disponible')->default(true);
        $table->string('image')->nullable();
        $table->unsignedBigInteger('user_id')->default(1);
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
