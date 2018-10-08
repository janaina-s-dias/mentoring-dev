<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrers', function (Blueprint $table) {
            $table->increments('carrer_id');
            $table->string('carrer_name', 100)->unique();
            $table->boolean('carrer_active')->default(false);; //idem
            $table->unsignedInteger('fk_carrer_profession');
            $table->foreign('fk_carrer_profession')
                    ->references('profession_id')
                    ->on('professions')
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
        Schema::dropIfExists('carrers');
    }
}
