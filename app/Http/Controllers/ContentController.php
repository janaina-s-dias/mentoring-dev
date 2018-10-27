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

    public function show($id)
    {
        $conteudo = Content::join('knowledges', 'fk_content_knowledge', '=', 'knowledge_id')
                        ->join('users', 'fk_knowledge_user', '=', 'user_id')
                            ->join('subjects', 'fk_knowledge_subject', '=', 'subject_id')
                                ->where('content_id', $id)->first();

        
        return view('verConteudo', compact('conteudo'));
    }

    public function edit($id)
    {
        $conteudo = Content::find($id);
        
        return view('edits.conteudoEdit', compact('conteudo')); 
    }

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
            return back()->with('success', 'Alterado com sucesso');
        } catch (QueryException $ex) {
            return back()->with('failure', 'Erro ao alterar');
        }
    }

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
