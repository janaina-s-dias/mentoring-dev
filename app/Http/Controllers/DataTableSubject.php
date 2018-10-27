<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataTableSubject extends Controller
{
        public function PegaDadosAssunto(Request $request) {
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->subject_id;
            $sub_dados[] = $row->subject_name;
            $sub_dados[] = $row->carrer_name;
            $sub_dados[] = ($row->subject_active) ? 'Ativo' : 'Inativo';
            $sub_dados[] = ($row->subject_active) ?  
            "<form method='POST' action='".route('ativarsubject', $row->subject_id)."'>".
            method_field('PATCH').
            @csrf_field().
            "<button type='submit' role='button' class='btn btn-warning' data-toggle='tooltip' title='Inativar Item'><i class='fa fa-times'></i></button> </span></button> </form>" : 

            "<form method='POST' action='".route('ativarsubject', $row->subject_id)."'>".
            method_field('PATCH').
            @csrf_field()."<button type='submit' role='button' class='btn btn-success' data-toggle='tooltip' title='Ativar Item'><i class='fa fa-check'></i></button> </button></form>";
                  
            $sub_dados[] = "<a href='".route('subject.edit', $row->subject_id)."' role='button' class='btn btn-primary' data-toggle='tooltip' title='Alterar'><span class='glyphicon glyphicon-edit'></span></a>";
            $sub_dados[] = "<form method='POST' action='".route('subject.destroy', $row->subject_id)."'>".
                            method_field('DELETE').
                            csrf_field().
                            "<button type='submit' role='button' class='btn btn-danger' data-toggle='tooltip' title='Excluir Item'><span class='glyphicon glyphicon-trash'></span></button></form>";
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
    private $order = ['subject_id','subject_name', 'subject_active','carrer_name', null, null ];
    
    public function CriarQuery(Request $request)
    {
        $this->subject = Subject::select('subject_id','subject_name', 'subject_active', 'carrer_name')
            ->join('carrers', 'carrer_id', '=', 'fk_subject_carrer');

       
        if($request->input('search.value') != null)
        {
            $this->subject->where('subject_name', 'like' ,'%', $request->input('search.value'));            
        }
        if($request->order!= null)
        {
            $this->subject->orderBy(array_get($this->order, $request->input('order.0.column')),
                                $request->input('order.0.dir'));
        }
        else
        {
            $this->subject->orderBy('subject_id', 'asc');
        }
    }
    
    public function CriarDataTable(Request $request)
    {
        $this->CriarQuery($request);
        if($request->length != -1)
        {
            $this->subject->offset($request->start)->limit($request->length);
        }
        $query = $this->subject->get();
        return $query;
    }
    
    public function RegistrosFiltrados(Request $request)
    {
        $this->CriarQuery($request);
        $query = $this->subject->count();
        return $query;
    }
    
    public function TodosRegistros()
    {
        $subject = Subject::all();
        return $subject->count();
    }
}
