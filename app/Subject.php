<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $primaryKey = 'subject_id';
    protected $table = 'subjects';
    protected $fillable = [
        'subject_name', 'subject_active', 'fk_subject_carrer'
    ];
    protected $rules;
    public $messages = [
        'subject_name.required' => 'A Nome do assunto deve ser preenchido para seu cadastro',
        'subject_name.unique' => 'Este Assunto ja está cadastrada',
        'subject_name.max' => 'Digite no maximo 50 caracteres',
        'fk_subject_carrer.required' => 'Carreira é obrigatoria'
    ];
    
    public function Regras($tipo = 'insert')
    {
        switch ($tipo)
        {
            case 'insert':
                $this->rules = ['subject_name' => 'bail|required|unique:subjects,subject_name|max:50',
                                'fk_subject_carrer' =>'required'];
            break;
        
            case 'update':
                $this->rules = ['subject_name' => 'required|max:50', 'fk_subject_carrer' =>'required'];
        }
    }
}
