<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Empresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('empresas', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('nombre')->unique();
        $table->string('direccion');
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
        // C:\laragon\www\newapirest\database\migrations\2021_04_23_162408_empresa.php
    }
}
