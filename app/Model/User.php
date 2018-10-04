<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
            'user_login'
        ,   'user_hash'
        ,   'user_cpf'
        ,   'user_nome' 
        ,   'user_rg' 
        ,   'user_email' 
        ,   'user_telefone' 
        ,   'user_celular' 
        ,   'user_knowledge' 
        ,   'user_account' 
        ,   'user_role' 
    ];
    protected $rules;
    protected $messages = [ 
            'user_login.unique' => 'Este usuario ja está sendo usado'
        ,   'user_login.max' => 'Coloque no maximo 50 caracteres'
        ,   'user_login.required' => 'O username é obrigatorio'
        ,   'user_hash.required' => 'A senha é obrigatoria' 
        ,   'user_hash.min' => 'A senha deve conter no minimo 8 caracteres'          
        ,   'user_hash.max' => 'A senha deve conter no maximo 50 caracteres'          
        ,   'user_cpf.unique' => 'Este CPF ja esta cadastrado'          
        ,   'user_cpf.min' => 'O CPF deve conter exatamente 11 digitos'          
        ,   'user_cpf.max' => 'O CPF deve conter exatemente 11 digitos'          
        ,   'user_cpf.required' => 'O CPF é obrigatorio'          
        ,   'user_nome.max' => 'O nome deve conter no maximo 100 caracteres'          
        ,   'user_nome.required' => 'O nome é obrigatorio'
        ,   'user_rg.min' => 'O RG deve ter exatamente 9 digitos'          
        ,   'user_rg.max' => 'O RG deve ter exatamente 9 digitos'          
        ,   'user_rg.required' => 'RG é obrigatorio'
        ,   'user_email.unique' => 'Email ja cadastrado'                    
        ,   'user_email.max' => 'O email deve ter no maximo 100 caracteres'
        ,   'user_email.required' => 'O email é obrigatorio'          
        ,   'user_telefone.max' => 'O telefone deve ter no maximo 11 caracteres'          
        ,   'user_celular.max' => 'O telefone celular deve ter no maximo 11 caracteres'
    ];
    
    public function Regras($tipo = 'insert') {
        switch ($tipo) {
            case 'insert':
                $this->rules = [
                        'user_login'        => 'bail|unique:users,user_login|max:50|required'
                    ,   'user_hash'         => 'bail|required||min:8|max:50'
                    ,   'user_cpf'          => 'bail|unique:users,user_cpf|min:11|max:11|required'
                    ,   'user_nome'         => 'bail|required|max:100'
                    ,   'user_rg'           => 'bail|required|min:9|max:9'
                    ,   'user_email'        => 'bail|unique:users,user_email|max:100|required' 
                    ,   'user_telefone'     => 'bail|max:11' 
                    ,   'user_celular'      => 'bail|max:11'
                ];
            break;
            case 'update':
                $this->rules = ['user_login' => 'bail|max:50|required', 'user_hash' => 'bail|required||min:8|max:50', 'user_cpf' => 'bail|min:11|max:11|required'
                    ,           'user_nome'  => 'bail|required|max:100', 'user_rg'  => 'bail|required|min:9|max:9',   'user_email' => 'bail|max:100|required' 
                    ,           'user_telefone' => 'bail|max:11', 'user_celular'=> 'bail|max:11'];
        }
    }
}
