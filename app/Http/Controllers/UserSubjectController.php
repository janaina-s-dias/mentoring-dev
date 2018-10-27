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
    
    public function editUserSubjectMentoria()
    {
        $us = UserSubject::select('*')
                ->join('subjects', 'subject_id', '=', 'fk_user_subject')
                ->join('carrers', 'carrer_id', '=', 'fk_subject_carrer')
                ->join('professions', 'profession_id', '=', 'fk_carrer_profession')
                ->get();
        $uss = array();
        foreach ($us as $s) {
            if($s->fk_subject_user == Auth::user()->user_id){
                $ussSub = array();
                 $kn = \App\Knowledge::select('*')
                    ->where('fk_knowledge_subject', $s->fk_user_subject)
                    ->where('fk_knowledge_user', $s->fk_subject_user)->count();
                if($kn == 0)
                {
                    $ussSub['mentor'] = "Não";
                }
                else 
                {
                    $ussSub['mentor'] = "Sim";
                }
                $ussSub['assunto'] = $s->subject_name;
                $ussSub['editar'] = "<a href='".route('editarMeuAssuntoSemMentoria', $s->subject_id)."' class='btn btn-primary'>Editar</a>";
                $ussSub['carreira'] = $s->carrer_name;
                $ussSub['profissao'] = $s->profession_name;
                $uss[] = $ussSub;
            }
        }
        echo json_encode($uss);
    }

    public function deletar($id, $id2)
    {
        $us = UserSubject::where('fk_user_subject', '=', intval($id2))->
                           where('fk_subject_user', '=', intval($id));
        $kw = \App\Knowledge::where('fk_knowledge_subject', '=', intval($id2))->
                           where('fk_knowledge_user', '=', intval($id));
        try {
            $us->delete();
            $kw->delete();
            return redirect('/AssuntosUsuarios')->with('success', 'Assunto removido dos seus interesses!');
        } catch (QueryException $exc) {
            return redirect('/AssuntosUsuarios')->with('failure', 'Assunto não removido dos seus interesses!');
        }
    }
}
