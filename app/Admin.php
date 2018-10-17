<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'admin_id';
    protected $table = 'admins';
    protected $fillable = [
        'admin_limit_knowledge',
        'admin_limit_user',
        'admin_user_active',
        'admin_user_fk'
    ];
    public $rules = [
        'admin_limit_knowledge' => 'bail|required|numeric',
        'admin_limit_user' => 'bail|required|numeric',
        'admin_user_active' => 'required',
        'admin_user_fk' => 'required'
    ];
    public $messages = [
        'admin_limit_knowledge.required' => 'Limite de Mentorados obrigatorio estar preenchido',
        'admin_limit_knowledge.numeric' => 'Limite deve ser um numero valido',
        'admin_limit_user.required' => 'Limite de Mentores obrigatorio estar preenchido',
        'admin_limit_user.numeric' => 'Limite deve ser um numero valido',
        'admin_user_active.required' => 'Status da Conta deve estar preenchido',
        'admin_user_fk.required' => 'Usuario vinculado deve estar preenchido'
    ];
}
