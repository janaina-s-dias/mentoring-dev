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
            $table->text('content_content')->nullable();
            $table->string('content_title', 100);
            $table->string('content_url', 200)->nullable(); //caminho do arquivo ou url do video
            $table->string('content_type', 20)->default('archive'); //tipo archive, tipo video, tipo conteudo(texto no site)
            $table->boolean('content_active')->default(true);
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
