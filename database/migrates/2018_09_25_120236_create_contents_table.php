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
            $table->string('content_descrition')->nullable();
            $table->string('content_title');
            $table->string('content_url')->nullable(); //caminho do arquivo ou url do video
            $table->string('content_type')->default('archive'); //tipo archive, tipo video, tipo conteudo(texto no site)
            $table->unsignedInteger('fk_content_knowledge');
            $table->foreign('fk_content_knowledge')
                    ->references('knowledge_id')
                    ->on('knowledges')
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
