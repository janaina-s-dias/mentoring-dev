<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKnowledgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledges', function (Blueprint $table) {
            $table->increments('knowledge_id');
            $table->double('knowledge_rank');
            $table->integer('knowledge_nivel');
            $table->boolean('knowledge_active'); //se foi aceito ou não como mentor pelos moderados, e ele mesmo pode de desligar como mentor mudando pra null
            $table->unsignedInteger('fk_knowledge_user');
            $table->unsignedInteger('fk_knowledge_subject');
            $table->foreign('fk_knowledge_user')
                    ->references('user_id')
                    ->on('users')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            $table->foreign('fk_knowledge_subject')
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
        Schema::dropIfExists('knowledge');
    }
}
