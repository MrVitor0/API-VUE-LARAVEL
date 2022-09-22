<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('desname');
            $table->string('desemail')->unique();
            $table->string('desdocument');
            $table->timestamp('dtbirth');
            $table->string('descep');
            $table->string('descidade');
            $table->string('desbairro');
            $table->string('deslogradouro');
            $table->string('descomplemento');
            $table->string('desnumero');
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
        Schema::dropIfExists('users');
    }
}
