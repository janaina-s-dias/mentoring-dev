<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataTableSolicitation extends Controller
{
    private $order = ['connection_start','connection_end', 'user_nome','knowledge_nivel'];
        public function PegaDadosSolicitacao(Request $request) {
        $pegadados = $this->CriarDataTable2($request);
        $dados = array();
        
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->user_nome; 
            $sub_dados[] = $row->subject_name;
            $sub_dados[] = 
            "<form method='POST' action='".route('aceitarPedido', $row->connection_id)."'>". 
                    method_field('PATCH').
                        @csrf_field().
            "<button type='submit' role='button' class='btn btn-primary' data-toggle='tooltip' title='Aceitar'><span>Aceitar</span></button> </form>" ;
            
                $sub_dados[] = 
            "<form method='POST' action='".route('excluirSolicitacao', $row->connection_id)."'>". 
                    method_field('DELETE').
                        @csrf_field().
            "<button type='submit' role='button' class='btn btn-danger' data-toggle='tooltip' title='Recusar'><span>Recusar</span></button> </form>" ;
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
  
     
    //Solicitações
    public function CriarQuery2(Request $request)
    {
        $this->connection = Connection::select('connection_id','connection_start','connection_end', 'user_nome', 'subject_name', 'fk_connection_user', 'fk_connection_knowledge')
            ->join('users', 'user_id', '=', 'fk_connection_user')
            ->join('knowledges', 'knowledge_id', '=', 'fk_connection_knowledge')
            ->join('subjects', 'subject_id', '=', 'fk_knowledge_subject')
                ->where('connection_status', '=', 0);
           
       
        if($request->input('search.value') != null)
        {
            $this->connection->where('user_nome', 'like' ,'%', $request->input('search.value'));            
        }
        if($request->order!= null)
        {
            $this->connection->orderBy(array_get($this->order, $request->input('order.0.column')),
                                $request->input('order.0.dir'));
        }
        else
        {
            $this->connection->orderBy('user_id', 'asc');
        }
    }
    
    public function CriarDataTable2(Request $request)
    {
        $this->CriarQuery2($request);
        if($request->length != -1)
        {
            $this->connection->offset($request->start)->limit($request->length);
        }
        $query = $this->connection->get();
        return $query;
    }
    
    public function RegistrosFiltrados2(Request $request)
    {
        $this->CriarQuery2($request);
        $query = $this->connection->count();
        return $query;
    }


    public function TodosRegistros()
    {
        $connection = Connection::all();
        return $connection->count();
    }

}
