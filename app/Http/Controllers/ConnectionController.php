<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Connection;
use Illuminate\Support\Facades\Auth;

class ConnectionController extends Controller
{

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
            $con->connection_end = date('Y/m/d', strtotime("+14 days",strtotime($dataAtual)));
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
                
            $con->connection_end = date('Y/m/d', strtotime("+14 days",strtotime($dataAtual)));
            $con->connection_status = 1;

            try {
                $con->update();
                return redirect('solicitacoes')->with('success', 'Conexao reiniciada!');
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect('solicitacoes')->with('failure', 'Conexao não reiniciada!');
            }
        }
        
    }

    
     public function finalizarMentoria($id)
     {
         $con = Connection::find($id);
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
      
     public function destroy($id) 
    {
        
        $con = Connection::find($id);        
        try {
            $con->delete();
                    return back()->with('success', 'Solicitação cancelada!');
            } catch (\Illuminate\Database\QueryException $ex) {
                return back()->with('failure', 'Solicitação não cancelada');
            }     
     }
}
