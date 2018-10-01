<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use App\Model\Segment;

class Segment extends Model
{
    protected $table = ['segments'];
    protected $fillable = ['segment_descrition'];
    private $rules = [];
    public $message = [];
    public function Store($attributes)
    {
        $segment = new Segment($attributes);        
        try
        {
            $segment->save();
            return "Salvo com sucesso";
        } catch (QueryException $exc) {
            return "Erro ao salvar";
        }
    }
    public function Update($attributes, $id)
    {
        $segment = Segment::find($id);
        $segment->segment_descrition = $attributes->segment_descrition;
        try
        {
            $segment->update();
            return "Atualizado com sucesso";
        } catch (QueryException $exc) {
            return "Erro ao atualizar";
        }
    }
    public function Destroy($id)
    {
        $segment = Segment::find($id);
        try {
            $segment->delete();
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
