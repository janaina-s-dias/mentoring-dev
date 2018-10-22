<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    protected $primaryKey = 'knowledge_id';
    protected $table = 'knowledges';
    protected $fillable = [
        'knowledge_rank',
        'knowledge_nivel',
        'knowledge_active',
        'fk_knowledge_user',
        'fk_knowledge_subject'
    ];

    public $rules = [
    	'knowledge_rank' => 'numeric',
        'knowledge_nivel' => 'required',
        // 'fk_knowledge_subject' => 'unique',
    ];

    public $messsages = [
    	'knowledge_rank.required' => 'Rank do Mentor é obrigatório',
    	'knowledge_rank.numeric' => 'Rank do Mentor deve ser numerico',
    	'knowledge_nivel.required' => 'Nivel de Conhecimento obrigatorio',
    	'knowledge_nivel.numeric' => 'Nivel de Conhecimento deve ser numerico',
    	'fk_knowledge_subject' => 'É obrigatorio inserir um assunto',
    	'fk_knowledge_user' => 'É obrigatorio informar o usuario vinculado'
    ];
}
