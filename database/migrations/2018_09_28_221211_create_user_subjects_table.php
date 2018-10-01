<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subjects', function (Blueprint $table) { // essa tabela é só pros mentorados, pois quando ele quer ser mentor, vai ficar esses dados na tabela mentor
            $table->unsignedInteger('fk_user_subject');
            $table->unsignedInteger('fk_subject_user');
            $table->foreign('fk_subject_user')
                    ->references('user_id')
                    ->on('users')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            $table->foreign('fk_user_subject')
                    ->references('subject_id')
                    ->on('subjects')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
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
        Schema::dropIfExists('user_subjects');
    }
}
