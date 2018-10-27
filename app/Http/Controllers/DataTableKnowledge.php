<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Knowledge;
use Illuminate\Support\Facades\Auth;

class DataTableKnowledge extends Controller
{
        public function PegaDadosKnowledge(Request $request) {

        $pegadados = $this->CriarDataTable($request);
        $dados = array();


        foreach ($pegadados as $row) {

            if($row->connection_status == null) {

            
                $sub_dados = array();
                $sub_dados[] = $row->subject_name; //subject_name
                $sub_dados[] = $row->knowledge_nivel;  //knowledge_nivel
                $sub_dados[] = $row->user_nome; //user_nome
                $sub_dados[] = $row->knowledge_rank; //rank
                $sub_dados[] = 
            
            
            "<form method='POST' action='".route('conexao', $row->knowledge_id)."'>".
                            method_field('POST'). 
                            @csrf_field().
            "<button type='submit' role='button' class='btn btn-success' data-toggle='tooltip' title='Solicitar'>Solicitar Mentoria</button> </span></button> </form>";
            
            
            $dados[] = $sub_dados;
            }
        }
        
        $output = array (
            "draw"  => intval($request->draw),
            "recordsTotal" => $this->TodosRegistros(), 
            "recordsFiltered" => $this->RegistrosFiltrados($request),
            "data" => $dados
        );
        echo json_encode($output);
    }



    private $order = ['subject_name','knowledge_nivel', 'user_nome','knowledge_rank', null];

    public function CriarQuery(Request $request)
    {
        $assunto = Knowledge::select('subject_id')
                            ->join('subjects', 'subject_id', '=', 'fk_knowledge_subject')
                            ->join('usersubjects', 'subject_id', '=', 'fk_user_subject')
                            ->where('fk_subject_user', Auth::user()->user_id)
                            ->where('fk_knowledge_user', '<>', Auth::user()->user_id)
                            ->where('knowledge_active', true)->get();  
        $assuntos = array();
        foreach ($assunto as $value) {
            $assuntos[] = $value->subject_id;
        }
        $this->knowledge = Knowledge::select('knowledge_id', 'subject_name','knowledge_nivel', 'user_nome', 'knowledge_rank', 'connection_status')
        ->join('users', 'user_id', '=', 'fk_knowledge_user')
            ->join('subjects', 'subject_id', '=', 'fk_knowledge_subject')
                ->leftJoin('connections', 'fk_connection_knowledge', '=', 'knowledge_id')
                        ->whereIn('subject_id', $assuntos);            
                //não pode aparecer mentores que ja estão conectados
                //opção cancelar na lista de mentores, caso o mentor já tenha sido solicitado para iniciar uma mentoria
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
    
    public function CriarDataTable(Request $request)
    {
        $this->CriarQuery($request);
        if($request->length != -1)
        {
            $this->knowledge->offset($request->start)->limit($request->length);
        }
        $query = $this->knowledge->get();
        return $query;
    }
    
    
    public function RegistrosFiltrados(Request $request)
    {
        $this->CriarQuery($request);
        $query = $this->knowledge->count();
        return $query;
    }
    
    public function TodosRegistros()
    {
        $knowledge = Knowledge::select('subject_id')
                            ->join('subjects', 'subject_id', '=', 'fk_knowledge_subject')
                            ->join('usersubjects', 'subject_id', '=', 'fk_user_subject')
                            ->where('fk_subject_user', Auth::user()->user_id)
                            ->where('fk_knowledge_user', '<>', Auth::user()->user_id)
                            ->where('knowledge_active', true)->count();
        return $knowledge;
    }

}
