<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubject extends Model
{
   protected $table = 'usersubjects';
   protected $fillable = [
   		'fk_user_subject', 'fk_subject_user'
   ];
   public $rules = [
       'fk_user_subject' => 'required',
       'fk_subject_user' => 'required'
   ];
   public $messages = [
       'fk_user_subject.required' => 'É obrigatorio informar Assunto',
       'fk_subject_user.required' => 'É obrigatorio informar Usuario'
   ];
}
