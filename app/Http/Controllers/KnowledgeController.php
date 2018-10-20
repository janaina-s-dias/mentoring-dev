<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Knowledge;
use Illuminate\Database\QueryException;

class KnowledgeController extends Controller
{
    function __construct(Request $request) {
       
    }


    public function store(Request $request)
    {
        $user = $request->session()->get('user');
        $knowledge = new Knowledge([
           'knowledge_nivel' => $request->knowledge_nivel, 
           'knowledge_rank' => 5, 
           'fk_knowledge_user' => $user->user_id,
           'fk_knowledge_subject' => $request->fk_user_subject
        ]);
        try
        {
            $knowledge->save();
            return false;
        } catch (Exception $ex) {
            return true;
        }
    }

    public function show($id)
    {
        $mentorias = Knowledge::join('subjects', 'subject_id', '=', 'fk_knowledge_subject')
                ->where('fk_knowledge', $id);
        $mentoria = array();
        foreach ($mentorias as $m) {
            $mentoria[] = $m;
        }
        echo json_encode($mentoria);
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


    public function PegaDadosKnowledge(Request $request) {

        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->subject_name; //subject_name
            $sub_dados[] = $row->knowledge_nivel;  //knowledge_nivel
            $sub_dados[] = $row->user_nome; //user_nome
            $sub_dados[] = $row->knowledge_rank; //rank
            $sub_dados[] = "<a href='#' role='button' class='btn btn-success'>Solicitar Mentoria</span></a>";
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
    private $order = ['subject_name','knowledge_nivel', 'user_nome','knowledge_rank', null];

    public function CriarQuery(Request $request)
    {
        $sessao = $request->session()->get('user');
        $assunto = Knowledge::select('subject_id')
                            ->join('subjects', 'subject_id', '=', 'fk_knowledge_subject')
                            ->join('usersubjects', 'subject_id', '=', 'fk_user_subject')
                            ->where('fk_subject_user', $sessao->user_id)->get();
        $assuntos = array();
        foreach ($assunto as $value) {
            $assuntos[] = $value->subject_id;
        }
        $this->knowledge = Knowledge::select('subject_name','knowledge_nivel', 'user_nome', 'knowledge_rank')
                ->join('users', 'user_id', '=', 'fk_knowledge_user')
                ->join('subjects', 'subject_id', '=', 'fk_knowledge_subject')
                        ->whereIn('subject_id', $assuntos);            
        //não pode aparecer mentores que ja estão conectados
        
        if($request->input('search.value') != null)
        {
            $this->knowledge->where('user_nome', 'like' ,'%', $request->input('search.value'));            
        }
        if($request->order!= null)
        {
            $this->knowledge->orderBy(array_get($this->order, $request->input('order.0.column')),
                                $request->input('order.0.dir'));
        }
        else
        {
            $this->knowledge->orderBy('knowledge_rank', 'desc');
        }
    }
    
    public function CriarDataTable(Request $request)
    {
        $this->CriarQuery($request);
        if($request->length != -1)
        {
            $this->knowledge->offset($request->start)->limit($request->length);
        }
        $query = $this->knowledge->get();
        return $query;
    }
    
    public function RegistrosFiltrados(Request $request)
    {
        $this->CriarQuery($request);
        $query = $this->knowledge->count();
        return $query;
    }

    public function TodosRegistros()
    {
        $knowledge = Knowledge::all();
        return $knowledge->count();
    }
}
