<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\UserSubject;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class UserSubjectController extends Controller
{
    private $us;
    public function __construct(UserSubject $us, Request $request) {
        $this->us = $us;
        
    }

    public function JsonPopular(Request $request)
    {
        $user = $request->get('user');
        $userSubject = \App\UserSubject::join('subjects', 'fk_user_subject', '=', 'subject_id')
                                        ->where('fk_subject_user', '=', $user);
        $dados = array();
        foreach ($userSubject as $value) {
            $subdados = array();
            $subdados['subject_name'] = $value->subject_name;
            $dados[] = $subdados;
        }
        return response()->json($dados);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, $this->us->rules, $this->us->messages);
        $userSessao = Auth::user();
        if($userSessao->user_knowledge && $request->knowledge_nivel > 2) 
        {
            $knowledge = new KnowledgeController(new \App\Knowledge());
            $result = $knowledge->store($request);
            if($result['bool'])
            {
                if($result['motivo'] == ''){
                    return redirect('/cadastroAssunto')->with('failure', 'Erro ocorreu ao vincular como mentor'); 
                }
                else
                {
                    return redirect('/cadastroAssunto')->with('failure', $result['motivo']); 
                }
            }
        }
        $us = new UserSubject([
            'fk_user_subject' => $request->fk_user_subject,
            'fk_subject_user' => $request->fk_subject_user
        ]);
        $user = UserSubject::where('fk_user_subject', '=', $request->fk_user_subject)->
                             where('fk_subject_user', '=', $request->fk_subject_user)->count();
        if($user == 0){
            try {
                $us->save();
                Auth::user()->user_knowledge;
                if (!Auth::user()->user_knowledge)
                {
                    $mensagem = "Assunto inserido em seus interesses!";
                }
                else {
                    $mensagem = "Assunto inserido em suas mentorias!";
                }
                
                return redirect('/cadastroAssunto')->with('success', $mensagem);
            } catch (QueryException $exc) {
                 if (!Auth::user()->user_knowledge)
                {
                    $mensagem = "Assunto não inserido em seus interesses!";
                }
                else {
                    $mensagem = "Assunto não inserido em suas mentorias!";
                }
                return redirect('/cadastroAssunto')->with('failure',  $$mensagem);  
            }
        }
        else
        {
            return redirect('/cadastroAssunto')->with('failure', 'Assunto já cadastrado em seus interesses!'); 
        }
            
   }

    public function show($id)
    {
        $us = UserSubject::join('subjects', 'fk_user_subject', '=', 'subject_id')
                         ->join('users','fk_subject_user','=','user_id')
                         ->where('user_id', $id)->get();
        $uss = array();
        foreach ($us as $s) {
            $ussSub = array();
            $ussSub['assunto'] = $s->subject_name;
            $uss[] = $ussSub;
        }
        echo json_encode($uss);
    }

    public function deletar($id, $id2)
    {
        $us = UserSubject::where('fk_user_subject', '=', intval($id2))->
                           where('fk_subject_user', '=', intval($id));
        try {
            $us->delete();
            return redirect('/AssuntosUsuarios')->with('success', 'Assunto removido dos seus interesses!');
        } catch (QueryException $exc) {
            return redirect('/AssuntosUsuarios')->with('failure', 'Assunto não removido dos seus interesses!');
        }
    }
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
                            "<button type='submit' role='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button>";
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
