<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrer extends Model
{
    protected $primaryKey = 'carrer_id';
    protected $table = 'carrers';
    protected $fillable = ['carrer_name', 'fk_carrer_profession', 'carrer_active'];
    protected $rules;
    public $messages = [
    	'carrer_name.required' => 'Nome da carreira é obrigatório!',
    	'carrer_name.unique' => 'Carreira já cadastrada!',
    	'carrer_name.max' => 'Nome da carreira deve conter no máximo 50 caracteres!',
    	'carrer_name.min' => 'Nome da carreira deve conter no mínimo 2 caracteres!',
    	'fk_carrer_profession.required' => 'Profissão obrigatória!'
    ];

    public function Regras($tipo = 'insert')
    {
    	switch ($tipo) {
    		case 'insert':
    			$this->rules = [
    				'carrer_name' => 'bail|required|unique:carrers,carrer_name|max:50|min:2',
    				'fk_carrer_profession' => 'required'
    			];
    			break;
    		
    		case 'update':
    				$this->rules = [
    				'carrer_name' => 'bail|required|max:50|min:2',
    				'fk_carrer_profession' => 'required'
    			];
    			break;
    	}
        return $this->rules;
    }
}
