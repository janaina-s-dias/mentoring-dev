<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Connection;
use Illuminate\Support\Facades\Auth;

class ConnectionController extends Controller
{
    function __construct(Request $request) {
        
    }

    public function salvar($knowledge)
    {

        $user = Auth::user();
        $con = new Connection([
           'fk_connection_user' => $user->user_id,
           'fk_connection_knowledge' => $knowledge
        ]);
        
        $conn = Connection::where('fk_connection_user', $user->user_id)->where('fk_connection_knowledge', $knowledge)->count();
        if($conn == 0){
            try {
                $con->save();
                return redirect('mentores')->with('success', 'Solicitação enviada, aguarde');
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect('mentores')->with('failure', 'Solicitação não enviada');
            }
        }
        else
        {
            return redirect('mentores')->with('failure', 'Solicitação já enviada, aguarde!');
        }
    }


    public function aceitarSolicitacao($id1){

        $con = Connection::find($id1);

        if($con->connection_start == null)
        {
            
            $dataAtual = date("Y/m/d");
                
            $con->connection_start = $dataAtual;
            $con->connection_end = date('d/m/Y', strtotime("+14 days",strtotime($dataAtual)));
            $con->connection_status = 1;

            try {
                $con->update();
                return redirect('solicitacoes')->with('success', 'Conexao iniciada!');
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect('solicitacoes')->with('failure', 'Conexao não iniciada!');
            }
        }
        else {
            $dataAtual = date("Y/m/d");
                
            $con->connection_end = date('d/m/Y', strtotime("+14 days",strtotime($dataAtual)));
            $con->connection_status = 1;

            try {
                $con->update();
                return redirect('solicitacoes')->with('success', 'Conexao reiniciada!');
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect('solicitacoes')->with('failure', 'Conexao não reiniciada!');
            }
        }
        
    }

    
     public function cancelarSolicitacao($id1)
     {
         $con = Connection::find($id1);
         $con->connection_status = 2;
         try {
             $con->update();
             return back()->with('success', 'Mentoria encerrada!');
             } catch (\Illuminate\Database\QueryException $ex) {
                 return back()->with('failure', 'Mentoria não encerrada');
             }
  
      }
      
      
      public function resolicitarConexao ($id){
         $con = Connection::find($id);
         $con->connection_status = 0;
         try {
             $con->update();
             return back()->with('success', 'Mentoria resolicitada!');
             } catch (\Illuminate\Database\QueryException $ex) {
                return back()->with('failure', 'Mentoria não resolicitada');
             }
             
      }
      
     public function excluirSolicitacao($id1) 
    {
        
        $con = Connection::find($id1);        
        try {
            $con->delete();
                    return back()->with('success', 'Solicitação cancelada!');
            } catch (\Illuminate\Database\QueryException $ex) {
                return back()->with('failure', 'Solicitação não cancelada');
            }
           
     }
        
 
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

    //Conexões
    public function PegaDadosConexao(Request $request) {

        $user = Auth::user();
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = date('d/m/Y', strtotime($row->connection_start));
            $sub_dados[] = $row->user_nome;  
            $sub_dados[] = $row->subject_name;
            if(Auth::user()->user_id == $row->fk_knowledge_user && intval($row->connection_status) == 0) {
                $sub_dados[] = "<button type='' role='button' class='btn btn-danger' data-toggle='tooltip' title='Aguardando...' disabled><span>Aguardando...</span></button> </form>";       
            } 
            else if(Auth::user()->user_id != $row->fk_knowledge_user && intval($row->connection_status) == 0) {
                $sub_dados[] = "<form method='POST' action='".route('excluirSolicitacao', $row->connection_id)."'>". 
                                    method_field('PATCH').
                                    @csrf_field().
                                "<button type='submit' role='button' class='btn btn-danger' data-toggle='tooltip' title='Cancelar'><span>Cancelar</span></button> </form>"; 
            
            } 
            else if(intval($row->connection_status) == 1) 
            { 
                $sub_dados[] = "<form method='POST' action='".route('cancelarSolicitacao', $row->connection_id)."'>". 
                                    method_field('PATCH').
                                    @csrf_field().
                                "<button type='submit' role='button' class='btn btn-danger' data-toggle='tooltip' title='Encerrar'><span>Encerrar</span></button> </form>";  
            
            } 
            else if(intval($row->connection_status) == 2)
            { 
                $sub_dados[] = "<form method='POST' action='".route('resolicitarConexao', $row->connection_id)."'>". 
                                    method_field('PATCH').
                                    @csrf_field().
                                "<button type='submit' role='button' class='btn btn-success' data-toggle='tooltip' title='Resolicitar'><span>Solicitar novamente</span></button> </form>";  
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
    private $order = ['connection_start','connection_end', 'user_nome','knowledge_nivel'];

    //Conexões
    public function CriarQuery(Request $request)
    {
        $user = Auth::user();
        $this->connection = Connection::select('connection_id','connection_start','connection_end', 'user_nome', 'subject_name', 'fk_knowledge_user', 'fk_connection_knowledge', 'connection_status')
            ->join('users', 'user_id', '=', 'fk_connection_user')
            ->join('knowledges', 'knowledge_id', '=', 'fk_connection_knowledge')
                    ->join('subjects', 'subject_id', '=', 'fk_knowledge_subject')
                        // ->whereNotNull('connection_status') 
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
    
    
    //Solicitações
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
