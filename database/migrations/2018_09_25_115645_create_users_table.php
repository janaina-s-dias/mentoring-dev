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
            $table->string('user_login', 40)->unique(); //coloca como unique direto no banco
            $table->string('user_hash', 100);
            $table->string('user_cpf', 11)->nullable()->unique(); //coloca como unique direto no banco
            $table->string('user_nome', 100)->nullable();
            $table->string('user_rg', 9)->nullable();
            $table->string('user_email', 100)->unique(); //coloca como unique direto no banco
            $table->string('user_telefone', 15)->nullable();
            $table->string('user_celular', 15)->nullable();
            $table->boolean('user_knowledge')->default(false); //se deseja ser mentor ou não, caso sim, fica true, caso não, fica false
            $table->tinyInteger('user_role')->default(1); // 1: user, 2: mentor, 3: moderator, 4: admin, 5: dev
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
