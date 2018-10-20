<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->date('connection_start'); 
            $table->date('connection_end')->nullable();
            $table->tinyInteger('connection_status')->default(0);  // 0-em solicitacão, 1-ativo, 2-encerrada
            $table->unsignedInteger('fk_connection_user');
            $table->unsignedInteger('fk_connection_knowledge');
            $table->foreign('fk_connection_user')
                    ->references('user_id')
                    ->on('users')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            $table->foreign('fk_connection_knowledge')
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
        Schema::dropIfExists('connections');
    }
}
