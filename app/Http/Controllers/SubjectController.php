<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use Illuminate\Database\QueryException;

class SubjectController extends Controller
{
    private $subject;
    
    function __construct(Subject $subject) {
        $this->subject = $subject;
    } 

    public function index()
    {
        $subject = Subject::all();
        $dados = array();
        foreach ($subject as $value) {
            $subdados = array();
            $subdados['subject_id'] = $value->subject_id;
            $subdados['subject_nome'] = $value->subject_name;
            $dados[] = $subdados;
        }
        echo json_encode($dados);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->subject->Regras(), $this->subject->messages);
        $subject = new Subject([
           'subject_name' => $request->subject_name, 
           'subject_active' => $request->subject_active, 
           'fk_subject_carrer' => $request->fk_subject_carrer
        ]);
        try
        {
            $subject->save();
            return redirect('/Assuntos')->with('success', 'Assunto salvo');
        } 
        catch (QueryException $ex) {
            return redirect('/Assuntos')->with('failure', 'Não foi possivel cadastrar o assunto', $request);
        }
    }

    public function show($id)
    {
        $subject = Subject::find($id)->first();
        redirect('subject.index')->with('finded', $subject);
    }

    public function edit($id, Request $request)
    {
        $subject = Subject::join('carrers','carrer_id','=','fk_subject_carrer')->where('subject_id','=',$id)->first();
        $request->session()->put('assunto', $subject);
        return view('edits.assuntoEdit');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->subject->Regras('update'), $this->subject->messages);
        $subject = Subject::find($id)->first();
        $subject->subject_name = $request->subject_name;
        $subject->subject_active = $request->subject_active;
        $subject->fk_subject_carrer = $request->fk_subject_carrer;
        try
        {
            $subject->update();
            $request->session()->forget('assunto');
            return redirect('/Assuntos')->with('success', 'Assunto alterado');
        } catch (QueryException $ex) {
            return redirect('/Assuntos')->with('failure', 'ERRO! Assunto não alterado');
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
        $subject = Subject::find($id)->first();
        try
        {
            $subject->delete();
            return redirect('/Assuntos')->with('success', 'Assunto deletado');
        } catch (QueryException $ex) {
            return redirect('/Assuntos')->with('failure', 'ERRO! Assunto não deletado');
        }
    }

    
    public function PegaDadosAssunto(Request $request) {
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->subject_id;
            $sub_dados[] = $row->subject_name;
            $sub_dados[] = ($row->subject_active) ? 'Ativo' : 'Inativo';
            $sub_dados[] = $row->carrer_name;
            $sub_dados[] = "<a href='".route('subject.edit', $row->subject_id)."' role='button' class='btn btn-success'><span class='glyphicon glyphicon-edit'></span></a>";
            $sub_dados[] = "<form method='POST' action=".route('subject.destroy', $row->subject_id)."'>".
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
    private $order = ['subject_id','subject_name', 'subject_active','carrer_name', null, null ];
    
    public function CriarQuery(Request $request)
    {
        $this->subject = Subject::select('subject_id','subject_name', 'subject_active', 'carrer_name')
            ->join('carrers', 'carrer_id', '=', 'fk_subject_carrer');

       
        if($request->input('search.value') != null)
        {
            $this->subject->where('subject_name', 'like' ,'%', $request->input('search.value'));            
        }
        if($request->order!= null)
        {
            $this->subject->orderBy(array_get($this->order, $request->input('order.0.column')),
                                $request->input('order.0.dir'));
        }
        else
        {
            $this->subject->orderBy('subject_id', 'desc');
        }
    }
    
    public function CriarDataTable(Request $request)
    {
        $this->CriarQuery($request);
        if($request->length != -1)
        {
            $this->subject->offset($request->start)->limit($request->length);
        }
        $query = $this->subject->get();
        return $query;
    }
    
    public function RegistrosFiltrados(Request $request)
    {
        $this->CriarQuery($request);
        $query = $this->subject->count();
        return $query;
    }
    
    public function TodosRegistros()
    {
        $subject = Subject::all();
        return $subject->count();
    }



}
