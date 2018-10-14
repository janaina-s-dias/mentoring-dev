<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubject extends Model
{
    protected $table = 'usersubjects';
    protected $fillable = [
        'fk_user_subject', 'fk_subject_user',
    ];
    public $rules = [
        'fk_user_subject' => 'required'
    ];
    public $messages = [
        'fk_user_subject' => 'Assunto obrigatorio'
    ];
}
