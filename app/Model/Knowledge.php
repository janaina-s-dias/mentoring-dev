<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    protected $table = 'knowledges';
    protected $fillable = [
        'knowledge_rank',
        'knowledge_nivel',
        'knowledge_active',
        'fk_knowledge_user',
        'fk_knowledge_subject'
    ];
}
