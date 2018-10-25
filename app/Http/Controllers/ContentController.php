<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Content;

class ContentController extends Controller
{
    private $content;
    function __construct(Content $content) {
        $this->content = $content;
    }
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
    public function store(Request $request)
    {
        $this->validate($request, $this->content->Regras(), $this->content->messages);
        $content = new \App\Content([
           'fk_content_knowledge' => $request->fk_content_knowledge,
           'content_content' => $request->content_content,
           'content_title' => $request->content_title,
           'content_type' => $request->content_type
        ]);
        
        try
        {
            $content->save();
            return redirect()->with('success', 'Cadastrado com sucesso');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->with('failure', 'Erro ao cadastrar');
        }
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



    public function PegaDadosConteudo(Request $request) {
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->subject_name;
            $sub_dados[] = $row->content_title;  
            $sub_dados[] = $row->content_type;
            $sub_dados[] = 
        
            // "<form method='POST' action='".route('', $row->content_id)."'>". 
            // method_field('').
            //     @csrf_field().
            "<button type='submit' role='button' class='btn btn-danger' data-toggle='tooltip' title='Visualizar'><span>Ver Conteúdo</span></button> </form>" ;  
            
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
    private $order = ['subject_name','content_title', 'content_type', null];

    //Conexões
    public function CriarQuery(Request $request)
    {
         
        $this->content = Content::select('content_title','content_type', 'fk_content_knowledge', 'subject_name')
            ->join('knowledge', 'knowledge_id', '=', 'fk_content_knowledge')
                ->join('subjects', 'subject_id', '=', 'fk_knowledge_subject');
                 
    
        if($request->input('search.value') != null)
        {
            $this->content->where('content_title', 'like' ,'%', $request->input('search.value'));            
        }
        if($request->order!= null)
        {
            $this->content->orderBy(array_get($this->order, $request->input('order.0.column')),
                                $request->input('order.0.dir'));
        }
        else
        {
            $this->content->orderBy('content_title', 'asc');
        }
    }
    
    //Conteudo
    public function CriarDataTable(Request $request)
    {
        $this->CriarQuery($request);
        if($request->length != -1)
        {
            $this->content->offset($request->start)->limit($request->length);
        }
        $query = $this->content->get();
        return $query;
    }
    
    public function RegistrosFiltrados(Request $request)
    {
        $this->CriarQuery($request);
        $query = $this->content->count();
        return $query;
    }
    
}
