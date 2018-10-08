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
            $table->double('knowledge_rank')->nullable();
            $table->smallInteger('knowledge_nivel')->default(1); //1. basico 2. pouco conhecimento 3. conhecimento mediano 4. conhecimento quase pleno 5. conhecimento pleno 6. bastante conhecimento 7. experiente no assunto 8. MESTRE NO ASSUNTO
            $table->boolean('knowledge_active')->default(false); //se foi aceito ou não como mentor pelos moderados, e ele mesmo pode de desligar como mentor mudando pra null
            $table->smallInteger('knowledge_limit')->default(5);
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
