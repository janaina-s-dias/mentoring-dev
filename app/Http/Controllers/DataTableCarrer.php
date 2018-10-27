<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataTableCarrer extends Controller
{
       public function PegaDadosCarreira(Request $request) {
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
             $sub_dados = array();
             $sub_dados[] = $row->carrer_id;
             $sub_dados[] = $row->carrer_name;
             $sub_dados[] = $row->profession_name;
             $sub_dados[] = ($row->carrer_active) ? 'Ativa' : 'Inativa';

             $sub_dados[] = ($row->carrer_active) ? 
            
             "<form method='POST' action='".route('ativarcarrer', $row->carrer_id)."'>".
                 method_field('PATCH').
                 @csrf_field().
             "<button type='submit' role='button' class='btn btn-warning' data-toggle='tooltip' title='Inativar Item'><i class='fa fa-times'></i></button> </span></button> </form>" : 
 
             "<form method='POST' action='".route('ativarcarrer', $row->carrer_id)."'>".
                 method_field('PATCH').
                 @csrf_field()."<button type='submit' role='button' class='btn btn-success' data-toggle='tooltip' title='Ativar Item'><i class='fa fa-check'></i></button> </button></form>";
             

             $sub_dados[] = "<a href='".route('carrer.edit', $row->carrer_id)."' role='button' class='btn btn-primary' data-toggle='tooltip' title='Alterar'><span class='glyphicon glyphicon-edit'></span></a>";
             $sub_dados[] = "<form method='POST' action='".route('carrer.destroy', $row->carrer_id)."'>".
                            method_field('DELETE').
                            csrf_field().
                            "<button type='submit' role='button' class='btn btn-danger' data-toggle='tooltip' title='Deletar Item'><span class='glyphicon glyphicon-trash'></span></button></form>";
            $dados[] = $sub_dados;
        }
        
        $output = array (
            "draw"  => intval($request->draw),
            "recordsTotal" => $this->TodosRegistros(), 
            "recordsFiltered" => $this->RegistrosFiltrados($request),
            "data" => $dados
        );
        echo json_encode($output);
    }
    private $order = ['carrer_id','carrer_name', 'carrer_active','profession_name', null, null ];

    public function CriarQuery(Request $request)
    {
        $this->carrer = Carrer::select('carrer_id','carrer_name', 'carrer_active', 'profession_name')
            ->join('professions', 'profession_id', '=', 'fk_carrer_profession');
           
       
        if($request->input('search.value') != null)
        {
            $this->carrer->where('carrer_name', 'like' ,'%', $request->input('search.value'));            
        }
        if($request->order!= null)
        {
            $this->carrer->orderBy(array_get($this->order, $request->input('order.0.column')),
                                $request->input('order.0.dir'));
        }
        else
        {
            $this->carrer->orderBy('carrer_id', 'asc');
        }
    }
    
    public function CriarDataTable(Request $request)
    {
        $this->CriarQuery($request);
        if($request->length != -1)
        {
            $this->carrer->offset($request->start)->limit($request->length);
        }
        $query = $this->carrer->get();
        return $query;
    }
    
    public function RegistrosFiltrados(Request $request)
    {
        $this->CriarQuery($request);
        $query = $this->carrer->count();
        return $query;
    }
    
    public function TodosRegistros()
    {
        $carrer = Carrer::all();
        return $carrer->count();
    }

}
