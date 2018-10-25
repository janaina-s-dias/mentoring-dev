<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Content;
use Illuminate\Database\QueryException;

class ContentController extends Controller
{
    private $content;
    function __construct(Content $content) {
        $this->content = $content;
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
            return redirect('conteudo')->with('success', 'Cadastrado com sucesso');
        } catch (QueryException $ex) {
            return redirect('conteudo')->with('failure', 'Erro ao cadastrar');
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
        $conteudo = Content::find($id);
        
        echo json_encode($conteudo); //muda pra onde vai mostrar se for com redirect ou por json, se for view, usa compact tipo
        //return view('ExibirConteudo', compact('conteudo'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conteudo = Content::find($id);
        
        echo json_encode($conteudo); //muda pra onde vai editar se for com redirect ou por json, se for view, usa compact tipo
        //return view('edits.conteudoEditar', compact('conteudo'); 
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
        $this->validate($request, $this->content->Regras(), $this->content->messages);
        $content = Content::find($id);
        $content->fk_content_knowledge = $request->fk_content_knowledge;
        $content->content_content = $request->content_content;
        $content->content_title = $request->content_title;
       
        try
        {
            $content->update();
            return redirect('editarConteudo')->with('success', 'Alterado com sucesso');
        } catch (QueryException $ex) {
            return redirect('editarConteudo')->with('failure', 'Erro ao alterar');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = Content::find($id);
        try {
            $content->delete();
            return back()->with('success', 'Deletado com sucesso');
        } catch (QueryException $ex) {
            return back()->with('failure', 'Erro ao deletar');
        }
    }
}
