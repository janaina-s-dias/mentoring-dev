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
}
