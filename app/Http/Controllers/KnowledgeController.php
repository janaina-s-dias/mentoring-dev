<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Knowledge;

class KnowledgeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        $this->knowledge = Knowledge::select('subject_name','knowledge_nivel', 'user_nome', 'knowledge_rank')
                ->join('users', 'user_id', '=', 'fk_knowledge_user')
                ->join('subjects', 'subject_id', '=', 'fk_knowledge_subject')
                        ->where('user_knowledge', '=', '1');            
 
        
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
