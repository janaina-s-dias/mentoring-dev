<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarrerController extends Controller
{
    private $carrer;
    
    function __construct(Carrer $carrer) {
        $this->carrer = $carrer;
    } 
    public function index()
    {
        //home do carrer
    }

    public function create()
    {
        //cadstro do carrer
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
        $carrer = new Carrer([
           'carrer_name' => $request->carrer_name, 
           'carrer_active' => $request->carrer_active, 
           'fk_carrer_profession' => $request->fk_carrer_profession
        ]);
        try
        {
            $carrer->save();
            redirect('carrer.index')->with('success', 'Carreira salva');
        } 
        catch (QueryException $ex) {
            redirect('carrer.create')->with('failure', 'Não foi possivel cadastrar a carreira', $request);
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
        $carrer = Carrer::find($id)->first();
        redirect('carrer.index')->with('finded', $carrer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carrer = Carrer::find($id)->first();
        redirect('carrer.edit')->with('finded', $carrer);
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
        $this->validate($request, $this->carrer->Regras('update'), $this->carrer->messages);
        $carrer = Carrer::find($id)->first();
        $carrer->carrer_name = $request->carrer_name;
        try
        {
            $carrer->update();
            redirect('carrer.index')->with('success', 'Carreira alterada');
        } catch (QueryException $ex) {
            redirect('subject.editar')->with('failure', 'ERRO! Carreira não alterada');
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
        $carrer = Carrer::find($id)->first();
        try
        {
            $carrer->delete();
            redirect('carrer.index')->with('success', 'Carreira deletada');
        } catch (QueryException $ex) {
            redirect('carrer.index')->with('failure', 'ERRO! Carreira não deletada');
        }
    }
}
