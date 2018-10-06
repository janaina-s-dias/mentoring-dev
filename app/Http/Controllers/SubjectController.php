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
        $this->validate($request, $this->subject->Regras(), $this->subject->messages);
        $subject = new Subject([
           'subject_name' => $request->subject_name, 
           'subject_active' => $request->subject_active, 
           'fk_subject_carrer' => $request->fk_subject_carrer
        ]);
        try
        {
            $subject->save();
            redirect('subject.index')->with('success', 'Assunto salvo');
        } 
        catch (QueryException $ex) {
            redirect('subject.create')->with('failure', 'Não foi possivel cadastrar o assunto', $request);
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
        $subject = Subject::find($id)->first();
        redirect('subject.index')->with('finded', $subject);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::find($id)->first();
        redirect('subject.edit')->with('finded', $subject);
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
        $this->validate($request, $this->subject->Rules('update'), $this->subject->messages);
        $subject = Subject::find($id)->first();
        $subject->subject_name = $request->subject_descrition;
        try
        {
            $subject->update();
            redirect('subject.index')->with('success', 'Assunto alterado');
        } catch (QueryException $ex) {
            redirect('subject.editar')->with('failure', 'ERRO! Assunto não alterado');
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
            redirect('subject.index')->with('success', 'Assunto deletado');
        } catch (QueryException $ex) {
            redirect('subject.editar')->with('failure', 'ERRO! Assunto não deletado');
        }
    }
}
