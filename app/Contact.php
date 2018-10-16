<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $primaryKey = 'contact_id';
    protected $table = 'contacts';
    protected $fillable = [
    	'contact_type',
    	'contact_description',
    	'fk_contact_user'
    ];
    protected $rules;
    protected $messages;
            
}
