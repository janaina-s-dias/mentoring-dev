<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('user_login'); //coloca como unique direto no banco
            $table->string('user_hash');
            //$table->string('user_cpf'); //coloca como unique direto no banco
            $table->string('user_nome');
            //$table->string('user_rg');
            //$table->string('user_email'); //coloca como unique direto no banco
            //$table->string('user_telefone');
            //$table->string('user_celular');
            //$table->boolean('user_knowledge')->default(true); //se deseja ser mentor ou não, caso sim, fica true, caso não, fica false
            //$table->boolean('user_account')->default(true);
            //$table->string('user_role')->default('user'); //user, mentor, moderator, admin
            $table->rememberToken(); //um bang pra recuperar senha
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
