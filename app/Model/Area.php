<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    protected $fillable = [
        'area_description', 'area_active'
    ];
    protected $rules = [
        'area_description' => 'required|unique:areas,area_description'
    ];
    protected $messages = [
        'area_description.required' => 'A Nome da área deve ser preenchido para seu cadastro',
        'area_description.unique' => 'Está area ja está cadastrada'
    ];
}
