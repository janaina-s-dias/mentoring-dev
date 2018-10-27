<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubject extends Model
{
    protected $primaryKey = 'usersubject_id';
    protected $table = 'usersubjects';
    protected $fillable = [
   		'fk_user_subject', 
                'fk_subject_user',
                'knowledge_rank',
                'knowledge_nivel',
                'knowledge_active'

   ];
   public $rules = [
       'fk_user_subject' => 'sometimes|required',
       'fk_subject_user' => 'sometimes|required',
       'knowledge_nivel' => 'sometimes|required'
   ];
   public $messages = [
        'fk_user_subject.required' => 'É obrigatório informar Assunto',
        'fk_subject_user.required' => 'É obrigatório informar Usuário',
    	'knowledge_rank.required' => 'Rank do Mentor é obrigatório',
    	'knowledge_nivel.required' => 'Nivel de Conhecimento obrigatorio'
    ];

}
