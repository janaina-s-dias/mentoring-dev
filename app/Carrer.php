<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrer extends Model
{
    protected $table = 'carrers';
    protected $fillable ['carrer_nome', 'fk_carrer_profession'];
    protected $rules;
    protected $messages = [
    	'carrer_nome.required' => 'Nome da Carreira é obrigatorio',
    	'carrer_nome.unique' => 'Carreira já cadastrada',
    	'carrer_nome.max' => 'Nome da carreira, no maximo 50 caracteres',
    	'carrer_nome.min' => 'Nome da carreira, no minimo 2 caracteres',
    	'fk_carrer_profession.required' => 'Profissão obrigatoria'
    ];

    public function Regras($tipo = 'insert')
    {
    	switch ($tipo) {
    		case 'insert':
    			$this->rules = [
    				'carrer_nome' => 'bail|required|unique:carrers,carrer_nome|max:50|min:2',
    				'fk_carrer_profession' => 'required'
    			];
    			break;
    		
    		case 'update':
    				$this->rules = [
    				'carrer_nome' => 'bail|required|max:50|min:2',
    				'fk_carrer_profession' => 'required'
    			];
    			break;
    	}
    }
}
