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
            $table->string('carrer_descrition');
            $table->boolean('carrer_active'); //idem 
            $table->integer('fk_carrer_area');
            $table->foreign('fk_carrer_area')
                    ->references('area_id')
                    ->on('areas')
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
