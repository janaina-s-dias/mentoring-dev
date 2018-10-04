<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    protected $table = ['professions'];
    protected $fillable = ['profession_descrition'];
    private $rules;
    public $message = [
        'profession_description.required' => 'A profissão é obrigatoria',
        'profession_description.unique' => 'Profissão ja existente',
        'profession_description.max' => 'Deve conter no maximo 50 caracteres',
    ];
    public function Rules($type = 'insert')
    {
        switch ($type) {
            case 'insert':
                return $this->rules = [
                    'profession_description' => 'bail|required|unique:professions,profession_descrition|max:50'
                ];
            case 'update':
                return $this->rules = [
                    'profession_description' => 'bail|required|max:50'
                ];
        }
    }
}
