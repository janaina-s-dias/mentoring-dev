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
    




}
