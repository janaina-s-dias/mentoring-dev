<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $primaryKey = 'contact_id';
    protected $table;
    protected $fillable;
    protected $rules;
    protected $messages;
            $table->string('contact_type', 20);
            $table->string('contact_description', 100);
            $table->unsignedInteger('fk_contact_user');

    
}
