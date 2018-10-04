<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suject extends Model
{
    protected $table = 'subjects';
    protected $fillable = [
        'subject_description', 'subject_active'
    ];
    protected $rules = [
        'subject_description' => 'required|unique:subjects,subject_description'
    ];
    protected $messages = [
        'subject_description.required' => 'A Nome da área deve ser preenchido para seu cadastro',
        'subject_description.unique' => 'Está subject ja está cadastrada'
    ];
}
