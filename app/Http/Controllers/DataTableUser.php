<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class DataTableUser extends Controller
{
        public function PegaDadosUsuario(Request $request) {
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
             $sub_dados = array();
             $sub_dados[] = $row->user_id;
             $sub_dados[] = $row->user_nome;
             $sub_dados[] = $row->user_login;
             $sub_dados[] = $row->user_email;
             $sub_dados[] = $row->user_cpf;
             $sub_dados[] = $row->user_rg;
             $sub_dados[] = $row->user_telefone;
             $sub_dados[] = $row->user_celular;
             $sub_dados[] = ($row->user_knowledge) ? 'Sim' : 'Não';
             //$sub_dados[] = "<button id='assuntos' value='".$row->user_id."' role='button' class='btn btn-primary'><span class='glyphicon glyphicon-eye-open'></span></a>";
             $sub_dados[] = "<form method='POST' action=".route('user.destroy', $row->user_id)."'>".
                            method_field('DELETE').
                            csrf_field().
                            "<button type='submit' role='button' class='btn btn-danger' data-toggle='tooltip' title='Excluir'><span class='glyphicon glyphicon-trash'></span></button>";
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
    private $order = ['user_id','user_nome', 'user_login','user_email', 'user_cpf', 'user_rg', 'user_telefone', 'user_celular', 'user_knowledge', null, null, null ];

    public function CriarQuery(Request $request)
    {
        $this->user = User::select('user_id','user_nome', 'user_login','user_email', 'user_cpf', 'user_rg', 'user_telefone', 'user_celular', 'user_knowledge');
        if($request->input('search.value') != null)
        {
            $this->carrer->where('user_name', 'like' ,'%', $request->input('search.value'));            
        }
        if($request->order!= null)
        {
            $this->user->orderBy(array_get($this->order, $request->input('order.0.column')),
                                $request->input('order.0.dir'));
        }
        else
        {
            $this->user->orderBy('user_id', 'asc');
        }
    }
    
    public function CriarDataTable(Request $request)
    {
        $this->CriarQuery($request);
        if($request->length != -1)
        {
            $this->user->offset($request->start)->limit($request->length);
        }
        $query = $this->user->get();
        return $query;
    }
    
    public function RegistrosFiltrados(Request $request)
    {
        $this->CriarQuery($request);
        $query = $this->user->count();
        return $query;
    }
    
    public function TodosRegistros()
    {
        $user = User::all();
        return $user->count();
    }
}
