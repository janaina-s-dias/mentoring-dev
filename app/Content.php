<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'contents';
    protected $fillable = [
        'content_description', 'content_title', 'content_url', 'content_type', 'fk_content_knowledge'
    ];
    protected $rules;
    
    public function Regras($tipo)
    {
        
    }
    protected $messages;
}
