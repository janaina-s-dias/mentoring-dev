<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('content_id');
            $table->string('content_descrition');
            $table->string('content_title');
            $table->string('content_url'); //caminho do arquivo ou url do video
            $table->integer('content_type'); //tipo arquivo, tipo video, tipo conteudo(texto no site)
            $table->integer('fk_content_user');
            $table->integer('fk_content_subject');
            $table->foreign('fk_content_user')
                    ->references('user_id')
                    ->on('users')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            $table->foreign('fk_content_subject')
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
        Schema::dropIfExists('contents');
    }
}
