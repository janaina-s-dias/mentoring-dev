<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserSubject;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class KnowledgeController extends Controller
{
    private $knowledge;
    function __construct(UserSubject $knowledge) {
       $this->knowledge = $knowledge;
    }

    public function criarMentorSobreAssunto($id)
    {
        return view('edits.editarMentor', compact('id'));
    }
    
    public function alteraMentor(Request $request)
    {
        $mentor = UserSubject::where('fk_subject_user', Auth::user()->user_id)
                           ->where('fk_user_subject', $request->fk_knowledge_subject)
                           ->whereNull('knowledge_nivel');
        if($mentor->count() == 0)
        {
            $mentor->knowledge_nivel = $request->knowledge_nivel;
            $mentor->knowledge_rank = 5;
            try
            {
                $mentor->update();
                return redirect('Mentoria_no_assunto')->with('success', 'Alterado com sucesso');
            } catch (QueryException $ex) {
                return redirect('Mentoria_no_assunto')->with('failure', 'Deu alguma merda ein');
            }
        }
        else
        {
            $knowledge = $mentor->first();
            $knowledge->knowledge_nivel = $request->knowledge_nivel;
            try
            {
                $knowledge->update();
                return redirect('Mentoria_no_assunto')->with('success', 'Alterado com sucesso');
            } catch (QueryException $ex) {
                return redirect('Mentoria_no_assunto')->with('failure', 'Deu alguma merda ein');
            }
            
        }
    }
    public function show($id)
    {
        $mentorias = UserSubject::join('subjects', 'subject_id', '=', 'fk_user_subject')
                ->where('fk_subject_user', $id)->get();
        $mentoria = array();
        foreach ($mentorias as $m) {
            $submentoria = array();
            $submentoria['assunto'] = $m->subject_name;
            $submentoria['assunto_id'] = $m->subject_id;
            $submentoria['mentor_id'] = $m->usersubject_id;
            $submentoria['nivel'] = intval($m->knowledge_nivel);
            $submentoria['rank'] = intval($m->knowledge_rank);
            $submentoria['ativo'] = boolval($m->knowledge_active);
            $submentoria['ativar'] = ($m->knowledge_active) ?       
                                        "<form method='POST' action='".route('ativarmentor', $m->usersubject_id)."'>".
                                            method_field('PATCH').
                                            @csrf_field().
                                        "<button type='submit' role='button' class='btn btn-warning' data-toggle='tooltip' title='Inativar Item'><i class='fa fa-times'></i></button> </span></button> </form>" : 
                                        "<form method='POST' action='".route('ativarmentor', $m->usersubject_id)."'>".
                                            method_field('PATCH').
                                            @csrf_field().
                                        "<button type='submit' role='button' class='btn btn-success' data-toggle='tooltip' title='Ativar Item'><i class='fa fa-check'></i></button> </button></form>";;
            $mentoria[] = $submentoria;
        }
        echo json_encode($mentoria);
    }

    public function showEditar(Request $request)
    {
        $id = $request->subject_id; 
        $user = UserSubject::join('subjects', 'subject_id', '=', 'fk_user_subject')
                ->where('fk_subject_user', $id)->get();
        $mentoria = array();
        foreach ($user as $m) {
            $submentoria = array();
            $submentoria['assunto'] = $m->subject_name;
            $submentoria['assunto_id'] = $m->subject_id;
            $submentoria['nivel'] = intval($m->knowledge_nivel);
            $submentoria['rank'] = intval($m->knowledge_rank);
            $submentoria['ativo'] = boolval($m->knowledge_active);
            $submentoria['ativar'] = ($m->knowledge_active) ?       
                                        "<form method='POST' action='".route('ativarmentor', $m->knowledge_id)."'>".
                                            method_field('PATCH').
                                            @csrf_field().
                                        "<button type='submit' role='button' class='btn btn-warning' data-toggle='tooltip' title='Inativar Item'><i class='fa fa-times'></i></button> </span></button> </form>" : 
                                        "<form method='POST' action='".route('ativarmentor', $m->knowledge_id)."'>".
                                            method_field('PATCH').
                                            @csrf_field().
                                        "<button type='submit' role='button' class='btn btn-success' data-toggle='tooltip' title='Ativar Item'><i class='fa fa-check'></i></button> </button></form>";;
            $mentoria[] = $submentoria;
        }
        echo json_encode($mentoria);
    }
    public function ativarMentor($id)
    { 
        $knowledge = UserSubject::find($id);

        if($knowledge->knowledge_active == true) $knowledge->knowledge_active = false;
        else if ($knowledge->knowledge_active == false) $knowledge->knowledge_active = true;
        else $knowledge->knowledge_active = false;
        try
        {
            $knowledge->update();
            return back()->with('success', 'Status alterado!');
          
         } catch (QueryException $ex) {
            return back()->with('failure', 'ERRO! Status não alterado!');
         }

    }
    
    public function edit($id)
    {
        $mentor = UserSubject::find($id);
        return redirect('EditarMentor')->with('mentor', $mentor);
    }

    public function atulizarRank($id, Request $request)
    {
        $mentor = UserSubject::find($id);
        $novoR = doubleval($mentor->knowledge_rank);
        $novo = ($novo + $request->rank) / 2;
        $mentor->knowledge_rank = $novo;
        try
        {
            $mentor->update();
            redirect('naoseideondevem')->with('success', 'Obrigado pela avaliação');
        }
        catch (QueryException $ex)
        {
            redirect('naoseideondevem')->with('failure', 'Erro ao dar a avaliação');
        }
        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->mentor->rules, $this->mentor->messsages);
        $mentor = UserSubject::find($id);
        $mentor->knowledge_nivel = $request->knowledge_nivel;
        try
        {
            $mentor->update();
            return back()->with('success', 'Mentor alterado');
        } catch (QueryException $ex) {
            return back()->with('failure', 'Mentor não alterado');
        }
    }
}