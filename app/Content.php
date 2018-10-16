<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $primaryKey = 'content_id';
    protected $table = 'contents';
    protected $fillable = [
        'content_content', 'content_title', 'content_url', 'content_type', 'fk_content_knowledge'
    ];
    protected $rules = ['content_content' => 'sometimes|required|min:10|max:65000',
                        'content_title' => 'required|min:10|max:100',
                        'content_url' => 'sometimes|bail|required|active_url',
                        'content_type' => 'bail|required|numeric'
        
    ];    
     protected $messages = ['content_content.required' => 'O Conteudo deve ser preenchido!',                        
                        'content_content.min' => 'O Cnteudo deve conter mais de 10 caracteres!',
                        'content_content.max' => 'Voce estrapolou todos os 65mil caracteres',
                        'content_title.required' => 'O título é obrigatório!',
                        'content_title.min' => 'O título deve conter mais de 10 caracteres!',
                        'content_title.max' => 'O título deve ter no maximo 100 caracteres!',
                        'content_url.required' => 'Url é obrigatória!',
                        'content_url.active_url' => 'O campo deve ser preenchido com uma url válida!',
                        'content_type.required' => 'O campo é obrigatório!'
         ];    
}
