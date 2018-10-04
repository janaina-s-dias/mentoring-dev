<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use App\Model\Profession;

class Profession extends Model
{
    protected $table = ['professions'];
    protected $fillable = ['profession_descrition'];
    private $rules = [];
    public $message = [];
    public function Store($attributes)
    {
        $profession = new Profession($attributes);        
        try
        {
            $profession->save();
            return "Salvo com sucesso";
        } catch (QueryException $exc) {
            return "Erro ao salvar";
        }
    }
    public function Update($attributes, $id)
    {
        $profession = Profession::find($id);
        $profession->profession_descrition = $attributes->profession_descrition;
        try
        {
            $profession->update();
            return "Atualizado com sucesso";
        } catch (QueryException $exc) {
            return "Erro ao atualizar";
        }
    }
    public function Destroy($id)
    {
        $profession = Profession::find($id);
        try {
            $profession->delete();
            return "Deletado com sucesso";
        } catch (QueryException $exc) {
            return "Erro ao deletar";

        }
    }
    public function Rules($type = 'insert')
    {
        switch ($type) {
            case 'insert':
                return $this->rules;
            case 'update':
                return $this->rules;
        }
    }
}
