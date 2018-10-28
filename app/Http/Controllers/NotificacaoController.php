<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Connection;
use Carbon\Carbon;

class NotificacaoController extends Controller
{
    public function pegaSolicitacao()
    {
        $conexao = Connection::select('subject_name', 'user_nome', 'connections.created_at')
            ->join('users', 'user_id', '=', 'fk_connection_user')
            ->join('knowledges', 'knowledge_id', '=', 'fk_connection_knowledge')
            ->join('subjects', 'subject_id', '=', 'fk_knowledge_subject')
                ->where('connection_status', '=', 0);
        if($conexao->count() > 0)
        {
            $json = $this->populaForeach($conexao);
            echo json_encode($json);
        }
        else
        {
            echo json_encode(array());
        }
    }
    
    private function populaForeach($conexao)
    {
        $conexaGet = $conexao->get();
        $dadosJson = array();
        foreach ($conexaGet as $linha) {
            $dadosParciais = array();
            $dadosParciais['nomeMentorado'] = $linha->user_nome;
            $dadosParciais['assunto'] = $linha->subject_name; 
            $dia = Carbon::parse($linha->created_at);
            $hora = Carbon::parse($linha->created_at)->subHour(3);
            $dadosParciais['dia'] = $dia->format('d/m/Y'); //2018-10-27 20:42:19
            $dadosParciais['hora'] = $hora->format('H:i');
            $dadosJson[] = $dadosParciais;
        }
        return $dadosJson;
    }
}
