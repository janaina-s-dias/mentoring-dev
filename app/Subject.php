<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $fillable = [
        'subject_description', 'subject_active', 'fk_subject_carrer'
    ];
    protected $rules;
    public $messages = [
        'subject_name.required' => 'A Nome da área deve ser preenchido para seu cadastro',
        'subject_name.unique' => 'Está subject ja está cadastrada',
        'fk_subject_carrer.required' => 'Carreira é obrigatoria'
    ];
    
    public function Regras($tipo = 'insert')
    {
        switch ($tipo)
        {
            case 'insert':
                $this->rules = ['subject_name' => 'bail|required|unique:subjects,subject_name',
                                'fk_subject_carrer' =>'required'];
            break;
        
            case 'update':
                $this->rules = ['subject_name' => 'required', 'fk_subject_carrer' =>'required'];
        }
    }
}
