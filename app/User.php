<?php

namespace App;

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
        ,   'user_role' 
    ];
    protected $rules;
    public $mensagens = [
        'user_login-login.required' => 'Usuario é obrigatorio',
        'user_hash-login.required' => 'Senha obrigatoria',
        'user_login.required' => 'Usuario é obrigatorio',
        'user_login.unique' => 'Usuario ja utilizado',
        'user_login.max' => 'Usuario muito grande',
        'user_login.min' => 'Usuario muito pequeno',
        'user_login.alpha_num' => 'O username deve ser somente letras e numeros',
        'user_hash.required' => 'Senha obrigatoria',
        'user_hash.min' => 'Senha muito pequena',
        'user_hash.max' => 'Senha muito grande',
        'user_hash-last.required' => 'Senha antiga é obrigatoria',
        'user_email.required' => 'Email obrigatorio',
        'user_email.email' => 'Email invalido',
        'user_email.max' => 'Email muito grande',
        'user_email.min' => 'Email muito pequeno',
        'user_email.unique' => 'Email já utilizado',
        'user_hash.confirmed' => 'Senha e Confirmação de Senha não coecidem' ,         
        'user_cpf.unique' => 'Este CPF ja esta cadastrado'  ,        
        'user_cpf.min' => 'O CPF deve conter exatamente 11 digitos' ,         
        'user_cpf.max' => 'O CPF deve conter exatemente 11 digitos'  ,        
        'user_cpf.required' => 'O CPF é obrigatorio'  ,        
        'user_nome.max' => 'O nome deve conter no maximo 100 caracteres' ,         
        'user_nome.required' => 'O nome é obrigatorio',
        'user_rg.min' => 'O RG deve ter exatamente 9 digitos'  ,        
        'user_rg.max' => 'O RG deve ter exatamente 9 digitos' ,         
        'user_rg.required' => 'RG é obrigatorio',
        'user_telefone.max' => 'O telefone deve ter no maximo 11 caracteres'    ,      
        'user_celular.max' => 'O telefone celular deve ter no maximo 11 caracteres',
        'user_cpf.numeric' => 'O CPF deve ser numero',
        'user_rg.numeric' => 'O RG deve ser numero',
        'user_celular.numeric' => 'O Telefone deve ser numero',
        'user_telefone.numeric' => 'O Celular deve ser numero'
    ];   
    public function Regras($tipo = 'insert1') {
        switch ($tipo) {
            case 'insert2':
                $this->rules = [
                        'user_cpf'          => 'bail|unique:users,user_cpf|min:11|max:11|required|numeric'
                    ,   'user_nome'         => 'bail|required|max:100'
                    ,   'user_rg'           => 'bail|required|min:9|max:9|numeric'
                    ,   'user_telefone'     => 'bail|max:11|numeric' 
                    ,   'user_celular'      => 'bail|max:11|numeric'
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
                    'user_login-login' => 'bail|required', 
                    'user_hash-login' => 'bail|required' 
                ];
            break;
            case 'senha':
                $this->rules = [
                    'user_hash-last' => 'bail|required',
                    'user_hash' => 'bail|required||min:8|max:50|confirmed'
                    ];
            break;
            case 'update':
                $this->rules = [
                    'user_login' => 'bail|max:50|required|alpha_num', 
                    'user_cpf' => 'bail|min:11|max:11|required|numeric',           
                    'user_nome'  => 'bail|required|max:100|numeric', 
                    'user_rg'  => 'bail|required|min:9|max:9|numeric',   
                    'user_email' => 'bail|max:100|required|email|min:10',           
                    'user_telefone' => 'bail|max:11|numeric', 
                    'user_celular'=> 'bail|max:11|numeric'
                ];
        }
        return $this->rules;
    }
}
