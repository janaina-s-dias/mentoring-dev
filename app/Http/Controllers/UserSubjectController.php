<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserSubject;
use Illuminate\Database\QueryException;

class UserSubjectController extends Controller
{
    private $us;
    public function __construct(UserSubject $us) {
        $this->us = $us;
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
        $this->validate($request, $this->us->rules, $this->us->messages);
        $us = new UserSubject([
            'fk_user_subject' => $request->subject,
            'fk_subject_user' => $request->user
        ]);
        try {
            $us->save();
            redirect('cadastroAssunto')->with('success', 'Assunto inserido em seus interesses');
        } catch (QueryException $exc) {
            redirect('cadastroAssunto')->with('failure', 'Assunto não inserido em seus interesses');
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
        $us = UserSubject::join('subjects', 'fk_user_subject', '=', 'subject_id')
                         ->join('users','fk_subject_user','=','user_id')
                         ->where('user_id', $id)->get();
         redirect('perfil')->with('assuntos', $us);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //não tem isso
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
        //não tem isso
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $us = UserSubject::find($id);
        try {
            $us->delete();
            redirect('assuntosUser')->with('success', 'Assunto removido dos interesses');
        } catch (QueryException $exc) {
            redirect('assuntosUser')->with('failure', 'Assunto não removido dos interesses');
        }
    }
}
