<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $primaryKey = 'contact_id';
    protected $table = 'contacts';
    protected $fillable = [
    	'contact_type',
    	'contact_description',
    	'fk_contact_user'
    ];
    public $rules = [
        'contact_type' => 'bail|required|max:20',
    	'contact_description' => 'bail|required|max:100',
    	'fk_contact_user' => 'required'
    ];
    public $messages = [
        'contact_type.required' => 'Campo de tipo de contato é de obrigatorio preenchimento',
        'contact_type.max' => 'Campo de tipo de contato de tamanho maximo de 20',
    	'contact_description.required' => 'Contato é de obrigatorio preenchimento',
    	'contact_description.max' => 'Contato de tamanho maximo de 100',
    	'fk_contact_user.required' => 'Usuario precisa estar logado'
    ];
            
}
