<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('contact_id');
            $table->string('contact_type');
            $table->string('contact_descrition');
            $table->integer('fk_contact_user');
            $table->foreign('fk_contact_user')
                    ->references('user_id')
                    ->on('users')
                    ->onDelete('cascate')
                    ->onUpdate('cascate');
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
        Schema::dropIfExists('contacts');
    }
}
