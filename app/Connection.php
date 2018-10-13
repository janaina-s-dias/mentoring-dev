<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $primaryKey = 'connection_id';
    protected $table;
    protected $fillable;
    protected $rules;
    protected $messages;
}
