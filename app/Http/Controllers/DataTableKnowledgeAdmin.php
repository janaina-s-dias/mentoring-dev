<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataTableKnowledgeAdmin extends Controller
{
    private $order = ['subject_name','knowledge_nivel', 'user_nome','knowledge_rank', null];
    
    public function PegaDadosKnowledgeAdmin(Request $request) {

        $pegadados = $this->CriarDataTableAdmin($request);
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->subject_name; 
            $sub_dados[] = $row->knowledge_nivel;  
            $sub_dados[] = $row->user_nome; 
            $sub_dados[] = $row->knowledge_rank; 
            $sub_dados[] = ($row->knowledge_active) ? 
            
            "<form method='POST' action='".route('ativarmentor', $row->knowledge_id)."'>".
                method_field('PATCH'). 
                @csrf_field().
            "<button type='submit' role='button' class='btn btn-warning' data-toggle='tooltip' title='Inativar Item'><i class='fa fa-times'></i></button> </span></button> </form>" : 

            "<form method='POST' action='".route('ativarmentor', $row->knowledge_id)."'>".
                method_field('PATCH').
                @csrf_field()."<button type='submit' role='button' class='btn btn-success' data-toggle='tooltip' title='Ativar Item'><i class='fa fa-check'></i></button> </button></form>";
            
            //$sub_dados[] = "<a href='".route('knowledge.edit', $row->knowledge_id)."' role='button' class='btn btn-primary' data-toggle='tooltip' title='Alterar'><span class='glyphicon glyphicon-edit'></span></a>";
            $sub_dados[] = "<form method='POST' action='".route('knowledge.destroy', $row->knowledge_id)."'>".
                            method_field('DELETE').
                            csrf_field().
                            "<button type='submit' role='button' class='btn btn-danger' data-toggle='tooltip' title='Excluir Item'><span class='glyphicon glyphicon-trash'></span></button></form>";
            $dados[] = $sub_dados;
        }
        
        $output = array (
            "draw"  => intval($request->draw),
            "recordsTotal" => $this->TodosRegistros(), 
            "recordsFiltered" => $this->RegistrosFiltradosAdmin($request),
            "data" => $dados
        );
        echo json_encode($output);
    }
    
    public function CriarQueryAdmin(Request $request)
    {
        $assunto = Knowledge::select('subject_id')
                            ->join('subjects', 'subject_id', '=', 'fk_knowledge_subject')
                            ->join('usersubjects', 'subject_id', '=', 'fk_user_subject')->get();
        $assuntos = array();
        
        foreach ($assunto as $value) {
            $assuntos[] = $value->subject_id;
        }

        $this->knowledge = Knowledge::select('knowledge_id', 'subject_name','knowledge_nivel', 'user_nome', 'knowledge_active','knowledge_rank')
                ->join('users', 'user_id', '=', 'fk_knowledge_user')
                ->join('subjects', 'subject_id', '=', 'fk_knowledge_subject')
                        ->whereIn('subject_id', $assuntos);            
                //não pode aparecer mentores que ja estão conectados
        
        if($request->input('search.value') != null)
        {
            $this->knowledge->where('user_nome', 'like' ,'%', $request->input('search.value'));            
        }
        if($request->order!= null)
        {
            $this->knowledge->orderBy(array_get($this->order, $request->input('order.0.column')),
                                $request->input('order.0.dir'));
        }
        else
        {
            $this->knowledge->orderBy('knowledge_rank', 'desc');
        }
    }
    
    public function RegistrosFiltradosAdmin(Request $request)
    {
        $this->CriarQueryAdmin($request);
        $query = $this->knowledge->count();
        return $query;
    }

    public function TodosRegistrosAdmin()
    {
        $knowledge = Knowledge::select('subject_id')
                            ->join('subjects', 'subject_id', '=', 'fk_knowledge_subject')
                            ->join('usersubjects', 'subject_id', '=', 'fk_user_subject')->count();
        return $knowledge;
    }
    
    public function CriarDataTableAdmin(Request $request)
    {
        $this->CriarQueryAdmin($request);
        if($request->length != -1)
        {
            $this->knowledge->offset($request->start)->limit($request->length);
        }
        $query = $this->knowledge->get();
        return $query;
    }
    
    
}
