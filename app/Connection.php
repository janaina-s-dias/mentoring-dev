<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $primaryKey = 'connection_id';
    protected $table = 'connections';
    protected $fillable = [
        'connection_start',
        'connection_end',
        'fk_connection_user',
        'fk_connection_knwledge'
    ];
    protected $rules;
    protected $messages;

}
