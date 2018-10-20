<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Connection;

class ConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function PegaDadosConexao(Request $request) {
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->connection_start;
            $sub_dados[] = $row->connection_end;
            $sub_dados[] = $row->user_nome; //user_nome
            $sub_dados[] = $row->knowledge_nivel; //knowledge_nivel
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
    private $order = ['connection_start','connection_end', 'user_nome','knowledge_nivel'];

    public function CriarQuery(Request $request)
    {
        $user = $request->session()->get('user');
        $this->connection = Connection::select('connection_start','connection_end', 'user_nome', 'knowledge_nivel')
            ->join('users', 'user_id', '=', 'fk_connection_user')
            ->join('knowledges', 'knowledge_id', '=', 'fk_connection_knowledge')
                ->whereNotNull('connection_end')
                ->where('user_id', $user->user_id);
           
       
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
    
    //
    public function CriarDataTable(Request $request)
    {
        $this->CriarQuery($request);
        if($request->length != -1)
        {
            $this->connection->offset($request->start)->limit($request->length);
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
    
//datatable solicitacoes
    public function PegaDadosSolicitacao(Request $request) {
        $pegadados = $this->CriarDataTable2($request);
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->connection_start;
            $sub_dados[] = $row->connection_end;
            $sub_dados[] = $row->user_nome; //user_nome
            $sub_dados[] = $row->knowledge_nivel; //knowledge_nivel
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
    //private $order = ['connection_start','connection_end', 'user_nome','knowledge_nivel', null];

    public function CriarQuery2(Request $request)
    {
        $this->connection = Connection::select('connection_start','connection_end', 'user_nome', 'knowledge_nivel')
            ->join('users', 'user_id', '=', 'fk_connection_user')
            ->join('knowledges', 'knowledge_id', '=', 'fk_connection_knowledge')
            ->whereNull('connection_end');
           
       
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
