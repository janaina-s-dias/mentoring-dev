<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    private $subject;
    
    function __construct(Subject $subject, Request $request) {
        $this->subject = $subject;
        
    } 

    public function JsonPopular(Request $request)
    {
        $carrer = $request->get('carreira');
        $subject = \App\Subject::where('fk_subject_carrer','=', $carrer)
                                                            ->where('subject_active', '=', '1')->get();
        $dados = array();
        foreach ($subject as $value) {
            $subarray = array();
            $subarray['subject_id'] = $value->subject_id;
            $subarray['subject_nome'] = $value->subject_name;
            $dados[]=$subarray;
        }
    return response()->json($dados);
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
            return redirect('/Assuntos')->with('success', 'Assunto salvo!');
        } 
        catch (QueryException $ex) {
            return redirect('/Assuntos')->with('failure', 'Não foi possivel cadastrar o assunto', $request);
        }
    }

    public function show($id)
    {
        $user = Subject::find($id);
        
        echo json_encode($user);
    }
    
    public function edit($id, Request $request)
    {
        $subject = Subject::join('carrers','carrer_id','=','fk_subject_carrer')->where('subject_id','=',$id)->get()->first();
        $request->session()->put('assunto', $subject);
        return redirect('EditarAssunto');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->subject->Regras('update'), $this->subject->messages);
        $subject = Subject::find($id);
        $subject->subject_name = $request->subject_name;
        $subject->subject_active = $request->subject_active;
        $subject->fk_subject_carrer = $request->fk_subject_carrer;
        try
        {
            $subject->update();
            $request->session()->forget('assunto');
            return redirect('/Assuntos')->with('success', 'Assunto alterado!');
        } catch (QueryException $ex) {
            return redirect('/Assuntos')->with('failure', 'ERRO! Assunto não alterado!');
        }
    }

    public function destroy($id)
    {
        $subject = Subject::find($id);
        try
        {
            $subject->delete();
            return redirect('/Assuntos')->with('success', 'Assunto deletado!');
        } catch (QueryException $ex) {
            return redirect('/Assuntos')->with('failure', 'ERRO! Assunto não deletado!');
        }
    }


    public function ativarAssunto($id)
    { 
        $subject = Subject::find($id);

        if($subject->subject_active == true) $subject->subject_active = false;
        else if ($subject->subject_active == false) $subject->subject_active = true;
        else $subject->subject_active = false;
        try
        {
            $subject->update();
            return redirect('/Assuntos')->with('success', 'Status alterado!');
          
         } catch (QueryException $ex) {
            return redirect('/Assuntos')->with('failure', 'ERRO! Status não alterado!');
         }

    }
    
    public function PegaDadosAssunto(Request $request) {
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->subject_id;
            $sub_dados[] = $row->subject_name;
            $sub_dados[] = $row->carrer_name;
            $sub_dados[] = ($row->subject_active) ? 'Ativo' : 'Inativo';
            $sub_dados[] = ($row->subject_active) ?  
            "<form method='POST' action='".route('ativarsubject', $row->subject_id)."'>".
            method_field('PATCH').
            @csrf_field().
            "<button type='submit' role='button' class='btn btn-warning' data-toggle='tooltip' title='Inativar Item'><i class='fa fa-times'></i></button> </span></button> </form>" : 

            "<form method='POST' action='".route('ativarsubject', $row->subject_id)."'>".
            method_field('PATCH').
            @csrf_field()."<button type='submit' role='button' class='btn btn-success' data-toggle='tooltip' title='Ativar Item'><i class='fa fa-check'></i></button> </button></form>";
                  
            $sub_dados[] = "<a href='".route('subject.edit', $row->subject_id)."' role='button' class='btn btn-primary' data-toggle='tooltip' title='Alterar'><span class='glyphicon glyphicon-edit'></span></a>";
            $sub_dados[] = "<form method='POST' action='".route('subject.destroy', $row->subject_id)."'>".
                            method_field('DELETE').
                            csrf_field().
                            "<button type='submit' role='button' class='btn btn-danger' data-toggle='tooltip' title='Excluir Item'><span class='glyphicon glyphicon-trash'></span></button></form>";
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
            $this->subject->orderBy('subject_id', 'asc');
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
