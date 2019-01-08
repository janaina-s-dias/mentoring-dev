<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Connection;
use Illuminate\Support\Facades\Auth;

class DataTableConnection extends Controller
{
    private $order = ['connection_start','connection_end', 'user_nome','knowledge_nivel'];

    public function PegaDadosConexao(Request $request) {
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = date('d/m/Y', strtotime($row->connection_start));
            $sub_dados[] = date('d/m/Y', strtotime($row->connection_end));
            $sub_dados[] = $row->user_nome;
            $sub_dados[] = $row->subject_name;
            $sub_dados[] = (intval($row->connection_status) == 1 && Auth::user()->user_id != $row->fk_knowledge_user) ?
                    "<a href='".route('chamaConteudos', $row->knowledge_id)."' role='button' class='btn' style='background-color: rgb(0,176,176); color: white'> Conteudos </a>" :
                    "<a href='".route('chamaConteudos', $row->knowledge_id)."' role='button' class='btn' style='background-color: rgb(0,176,176); color: white'> Meus Conteudos </a>";
            if(Auth::user()->user_id == $row->fk_knowledge_user && intval($row->connection_status) == 0) {
                $sub_dados[] = "<button type='' role='button' class='btn btn-default' data-toggle='tooltip' title='Aguardando...' disabled><span>Aguardando...</span></button> </form>";
            }
            else if(intval($row->connection_status) == 0) {
                $sub_dados[] = "<form method='POST' action='".route('excluirSolicitacao', $row->connection_id)."'>".
                                    method_field('DELETE').
                                    @csrf_field().
                                "<button type='submit' role='button' class='btn btn-danger' data-toggle='tooltip' title='Cancelar'><span>Cancelar</span></button> </form>";

            }
            else if(intval($row->connection_status) == 1)
            {
                $sub_dados[] = "<form method='POST' action='".route('finalizarMentoria', $row->connection_id)."'>".
                                    method_field('PATCH').
                                    @csrf_field().
                                "<button type='submit' role='button' class='btn btn-danger' data-toggle='tooltip' title='Encerrar'><span>Encerrar</span></button> </form>";

            }
            else if(intval($row->connection_status) == 2 && Auth::user()->user_id != $row->fk_knowledge_user)
            {
                $sub_dados[] = "<form method='POST' action='".route('resolicitarConexao', $row->connection_id)."'>".
                                    method_field('PATCH').
                                    @csrf_field().
                                "<button type='submit' role='button' class='btn btn-success' data-toggle='tooltip' title='Resolicitar'><span>Solicitar novamente</span></button> </form>";
            }
            else if(intval($row->connection_status) == 2 && Auth::user()->user_id == $row->fk_knowledge_user)
            {
                $sub_dados[] = "<button type='submit' role='button' class='btn btn-default' data-toggle='tooltip' title='Finalizada' disabled><span>Finalizada</span></button> </form>";
            }

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
    //Conexões
    public function CriarQuery(Request $request)
    {
        $user = Auth::user();
        $this->connection = Connection::select('connection_id','connection_start','connection_end', 'user_nome', 'subject_name', 'fk_knowledge_user', 'fk_connection_knowledge', 'connection_status', 'knowledge_id')
            ->join('users', 'user_id', '=', 'fk_connection_user')
            ->join('knowledges', 'knowledge_id', '=', 'fk_connection_knowledge')
                    ->join('subjects', 'subject_id', '=', 'fk_knowledge_subject')
                            ->where('fk_knowledge_user', $user->user_id)
                                ->orWhere('fk_connection_user', $user->user_id);

        //Conexao ainda nao aceita, deve ser visualizada pelo mentorado como "aguardando" na tela de conexões

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

    //Conexões
    public function CriarDataTable(Request $request)
    {
        $this->CriarQuery($request);
        if($request->length != -1)
        {
            //$this->connection->offset($request->start)->limit($request->length);
        }
        $query = $this->connection->get();
        return $query;
    }

        public function RegistrosFiltrados(Request $request)
    {
        $this->CriarQuery($request);
        $query = $this->connection->count();
        return $query;
    }

        public function TodosRegistros()
    {
        $connection = Connection::all();
        return $connection->count();
    }

}
