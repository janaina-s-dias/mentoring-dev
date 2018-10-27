<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Knowledge;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class KnowledgeController extends Controller
{
    private $knowledge;
    function __construct(Knowledge $knowledge) {
       $this->knowledge = $knowledge;
    }

    public function criarMentorSobreAssunto($id)
    {
        return view('edits.editarMentor', compact('id'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, $this->knowledge->rules, $this->knowledge->messsages);
        $knowledge = new Knowledge([
           'knowledge_nivel' => $request->knowledge_nivel, 
           'knowledge_rank' => 5, 
           'fk_knowledge_user' => Auth::user()->user_id,
           'fk_knowledge_subject' => $request->fk_user_subject
        ]);
        $mentor = Knowledge::where('fk_knowledge_user', '=', Auth::user()->user_id)->
                             where('fk_knowledge_subject', '=', $request->fk_user_subject)->count();
        if($mentor == 0){
            try
            {
                $knowledge->save();
                return array('bool' => false);
            } catch (QueryException $ex) {
                return array('bool' => true, 'motivo' => '');
            }
        }
        else
        {
            return array('bool' => true, 'motivo' => 'Não pode haver mentoria no mesmo assunto');
        }
    }
    public function alteraMentor(Request $request)
    {
        $mentor = Knowledge::where('fk_knowledge_user', Auth::user()->user_id)
                           ->where('fk_knowledge_subject', $request->fk_knowledge_subject);
        if($mentor->count() == 0)
        {
            $this->validate($request, ['knowledge_nivel' => 'required'], ['knowledge_nivel.required' => 'Nivel obrigatorio']);
            $knowledge = new Knowledge([
               'knowledge_nivel' => $request->knowledge_nivel, 
               'knowledge_rank' => 5, 
               'fk_knowledge_user' => Auth::user()->user_id,
               'fk_knowledge_subject' => $request->fk_knowledge_subject
            ]);
            try
            {
                $knowledge->save();
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
        $mentorias = Knowledge::join('subjects', 'subject_id', '=', 'fk_knowledge_subject')
                ->where('fk_knowledge_user', $id)->get();
        $mentoria = array();
        foreach ($mentorias as $m) {
            $submentoria = array();
            $submentoria['assunto'] = $m->subject_name;
            $submentoria['assunto_id'] = $m->subject_id;
            $submentoria['mentor_id'] = $m->knowledge_id;
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

    public function showEditar(Request $request)
    {
        $id = $request->subject_id; 
        $user = Knowledge::join('subjects', 'subject_id', '=', 'fk_knowledge_subject')
                ->where('fk_knowledge_user', $id)->get();
        $mentoria = array();
        foreach ($mentorias as $m) {
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
        $knowledge = Knowledge::find($id);

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
        $mentor = Knowledge::find($id);
        return redirect('EditarMentor')->with('mentor', $mentor);
    }

    public function atulizarRank($id)
    {
        $mentor = Knowledge::find($id);
        $novo = doubleval($mentor->knowledge_rank);
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
        $mentor = Knowledge::find($id);
        $mentor->knowledge_nivel = $request->knowledge_nivel;
        try
        {
            $mentor->update();
            return redirect('mentoresAdmin')->with('success', 'Mentor alterado');
        } catch (QueryException $ex) {
            return redirect('mentoresAdmin')->with('failure', 'Mentor não alterado');
        }
    }

    public function destroy($id)
    {
        $mentor = Knowledge::find($id);
        $user = \App\UserSubject::where('fk_user_subject', '=', intval($mentor->fk_knowledge_subject))->
                           where('fk_subject_user', '=', intval($mentor->fk_knowledge_user));
        try
        {
            $user->delete();
            $mentor->delete();
            return redirect('mentoresAdmin')->with('success', 'Mentor deletado');
        } catch (QueryException $ex) {
            return redirect('mentoresAdmin')->with('failure', 'Mentor não deletado');
        }
    }
}