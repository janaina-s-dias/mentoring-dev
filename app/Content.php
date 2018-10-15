<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $primaryKey = 'content_id';
    protected $table = 'contents';
    protected $fillable = [
        'content_description', 'content_title', 'content_url', 'content_type', 'fk_content_knowledge'
    ];
    protected $rules = ['content_description' => 'required|min:10|max:100',
                        'content_title' => 'required|min:10|max:20',
                        'content_url' => 'bail|required|active_url',
                        'content_type' => 'bail|required|file', //(???)
        
    ];    
     protected $messages = ['content_description.required' => 'O campo descrição deve ser preenchido!',                        
                        'content_description.min' => 'O campo descrição deve conter mais de 10 caracteres!',
                        'content_description.max' => 'O campo nome deve conter no máximo 100 caracteres!',
                        'content_title.required' => 'O campo é obrigatório!',
                        'content_title..min' => 'O campo título deve conter mais de 10 caracteres!',
                        'content_title.max' => 'O campo título deve ter no maximo 20 caracteres!',
                        'content_url.required' => 'O campo é obrigatório!',
                        'content_url.active_url' => 'O campo deve ser preenchido com uma url válida!',
                        'content_type.required' => 'O campo é obrigatório!'
         ];    
    public function Regras($tipo)
    {
        
    }
}
