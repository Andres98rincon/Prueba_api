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
        Schema::create('winners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('awards_id')->unique()->comment('llave foranea de premios');
            $table->string('name')->comment('nombre del ganador');
            $table->string('lastname')->comment('apellido del ganador');
            $table->string('address')->comment('direccion del ganador');
            $table->string('phone')->comment('telefono del ganador');
            $table->string('email')->comment('correo del ganador');

            $table->foreign('awards_id')->references('id')->on('awards');
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
        Schema::dropIfExists('winners');
    }
};
