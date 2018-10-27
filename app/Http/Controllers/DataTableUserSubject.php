<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserSubject;

class DataTableUserSubject extends Controller
{
    public function PegaDadosUsuarioAssunto(Request $request) {
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
             $sub_dados = array();
             $sub_dados[] = $row->user_nome;
             $sub_dados[] = $row->subject_name;
             $sub_dados[] = $row->carrer_name;
             $sub_dados[] = $row->profession_name;
        $sub_dados[] = "<form method='POST' action=".route('usersubject.deletar',array('user' => $row->fk_subject_user, 'subject' => $row->fk_user_subject))."'>".
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
    private $order = ['user_nome', 'subject_name','carrer_name', 'profession_name', null ];

    public function CriarQuery(Request $request)
    {
        $this->user = UserSubject::select('*')
                ->join('users', 'user_id', '=', 'fk_subject_user')
                ->join('subjects', 'subject_id', '=', 'fk_user_subject')
                ->join('carrers', 'carrer_id', '=', 'fk_subject_carrer')
                ->join('professions', 'profession_id', '=', 'fk_carrer_profession');
        if($request->input('search.value') != null)
        {
            $this->carrer->where('user_name', 'like' ,'%', $request->input('search.value'));            
            $this->carrer->Orwhere('subject_name', 'like' ,'%', $request->input('search.value'));            
            $this->carrer->Orwhere('carrer_name', 'like' ,'%', $request->input('search.value'));            
            $this->carrer->Orwhere('profession_name', 'like' ,'%', $request->input('search.value'));            
        }
        if($request->order!= null)
        {
            $this->user->orderBy(array_get($this->order, $request->input('order.0.column')),
                                $request->input('order.0.dir'));
        }
        else
        {
              $this->user->orderBy('user_id', 'asc'); //troquei o created_at por user_id na coluna de ordenação, pois estava retornando violação do SQL State
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
        $user = UserSubject::all();
        return $user->count();
    }
}
