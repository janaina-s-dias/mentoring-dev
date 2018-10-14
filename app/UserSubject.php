<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubject extends Model
{
   protected $table = 'usersubjects';
   protected $rules = [
       'fk_user_subject' => 'required',
       'fk_subject_user' => 'required'
   ];
   protected $messages = [
       'fk_user_subject.required' => 'É obrigatorio informar Assunto',
       'fk_subject_user.required' => 'É obrigatorio informar Usuario'
   ];
}
