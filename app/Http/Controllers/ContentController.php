<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
    public function store(Request $request)
    {
        $this->validate($request, ['fk_content_knowledge' => 'required', 'content_content' => 'required', 'content_type' => 'required'],['fk_content_knowledge.required' => 'Assunto obrigatorio', 'content_content.required' => 'Conteudo obrigatorio', 'content_type.required' => 'Tipo obrigatorio']);
        $content = new \App\Content([
           'fk_content_knowledge' => $request->fk_content_knowledge,
           'content_content' => $request->content_content,
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
}
