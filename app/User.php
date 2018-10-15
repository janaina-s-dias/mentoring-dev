<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $primaryKey = 'user_id';
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
        ,   'user_role' 
    ];
    protected $rules;
    public $mensagens = [
        'user_login_login.required' => 'Usuário é obrigatório!',
        'user_hash_login.required' => 'Senha obrigatória!',
        'user_login.required' => 'Campo usuario é obrigatório!',
        'user_login.unique' => 'Usuário já existente. Insira outro usuário!',
        'user_login.max' => 'Usuário informado contém mais caracteres que o máximo permitido!',
        'user_login.min' => 'Usuário informado contém menos caracteres que o mínimo permitido!',
        'user_login.alpha_num' => 'O username deve conter somente letras e números!',
        'user_hash.required' => 'Senha obrigatória!',
        'user_hash.min' => 'Senha informada muito pequena!',
        'user_hash.max' => 'Senha informada muito grande!',
        'user_hash-last.required' => 'Senha antiga é obrigatória!',
        'user_email.required' => 'Email obrigatório',
        'user_email.email' => 'Email inválido',
        'user_email.max' => 'Email muito grande',
        'user_email.min' => 'Email muito pequeno',
        'user_email.unique' => 'Email já utilizado',
        'user_hash.confirmed' => 'Senha e Confirmação de Senha não coecidem' ,         
        'user_cpf.unique' => 'Este CPF ja esta cadastrado'  ,                 
        'user_cpf.digits' => 'O CPF deve conter 11 digitos e ser numerico'  ,        
        'user_cpf.required' => 'O CPF é obrigatorio'  ,        
        'user_nome.max' => 'O nome deve conter no maximo 100 caracteres' ,         
        'user_nome.required' => 'O nome é obrigatorio',       
        'user_rg.digits' => 'O RG deve ter 9 digitos e ser numerico' ,         
        'user_rg.required' => 'RG é obrigatorio',
        'user_telefone.max' => 'O telefone deve ter no maximo 15 digitos'    ,      
        'user_celular.max' => 'O telefone celular deve ter no maximo 15 digitos'
    ];   
    public function Regras($tipo = 'insert1') {
        switch ($tipo) {
            case 'insert2':
                $this->rules = [
                        'user_cpf'          => 'bail|unique:users,user_cpf|required|digits:11'
                    ,   'user_nome'         => 'bail|required|max:100'
                    ,   'user_rg'           => 'bail|required|digits:9'
                    ,   'user_telefone'     => 'bail|max:15' 
                    ,   'user_celular'      => 'bail|max:15'
                ];
            break;
            case 'insert1':
                $this->rules = [
                    'user_login' => 'bail|required|unique:users,user_login|max:100|min:5|alpha_num', 
                    'user_hash' => 'bail|required|max:100|min:8|confirmed',
                    'user_email' => 'bail|required|email|max:100|min:10|unique:users,user_email'];
                break;
            case 'login':
                $this->rules = [
                    'user_login_login' => 'bail|required', 
                    'user_hash_login' => 'bail|required' 
                ];
            break;
            case 'senha':
                $this->rules = [
                    'user_hash' => 'bail|required',
                    'new_user_hash' => 'bail|required||min:8|max:50|confirmed'
                    ];
            break;
            case 'update':
                $this->rules = [
                    'user_login' => 'bail|max:50|required|alpha_num', 
                    'user_cpf' => 'bail|digits:11|required',           
                    'user_nome'  => 'bail|required|max:100', 
                    'user_rg'  => 'bail|required|digits:9',   
                    'user_email' => 'bail|max:100|required|email|min:10',           
                    'user_telefone' => 'bail|max:15', 
                    'user_celular'=> 'bail|max:15'
                ];
        }
        return $this->rules;
    }
}
