<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserSubject extends Model
{
    protected $table = 'usersubjects';
    protected $fillable = [
        'fk_user_subject', 'fk_subject_user',
    ];
    protected $rules = [];
    protected $messages = [];
}
