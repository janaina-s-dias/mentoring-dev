<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrer;
use Illuminate\Database\QueryException;

class CarrerController extends Controller
{
    private $carrer;
    
    function __construct(Carrer $carrer, Request $request) {
        $this->carrer = $carrer;
    } 
    
    public function JsonPopular(Request $request)
    {
        $profession = $request->get('profissao');
        $carrer = \App\Carrer::where('fk_carrer_profession', '=', $profession)->
                                                            where('carrer_active', '=', '1')->get();
        $dados = array();
        foreach ($carrer as $value) {
            $subarray = array();
            $subarray['carrer_id'] = $value->carrer_id;
            $subarray['carrer_nome'] = $value->carrer_name;
            $dados[]=$subarray;
        }
    return response()->json($dados);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, $this->carrer->Regras(), $this->carrer->messages);
        $carrer = new Carrer([
           'carrer_name' => $request->carrer_name, 
           'carrer_active' => $request->carrer_active, 
           'fk_carrer_profession' => $request->fk_carrer_profession
        ]);
        try
        {
            $carrer->save();
            return redirect('/Carreiras')->with('success', 'Carreira salva!');
        } 
        catch (QueryException $ex) {
            return redirect('/Carreiras')->with('failure', 'Não foi possivel cadastrar a carreira', $request);
        }
    }
    
    public function edit($id, Request $request)
    {
        $carrer = Carrer::find($id);
        $request->session()->put('carreira', $carrer);
        return redirect('EditarCarreira');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->carrer->Regras('update'), $this->carrer->messages);
        $carrer = Carrer::find($id);
        $carrer->carrer_name = $request->carrer_name;
        $carrer->carrer_active = $request->carrer_active;
        $carrer->fk_carrer_profession = $request->fk_carrer_profession;
        try
        {
            $carrer->update();
            $request->session()->forget('carreira');
            return redirect('/Carreiras')->with('success', 'Carreira alterada!');
        } catch (QueryException $ex) {
            return redirect('/Carreiras')->with('failure', 'ERRO! Carreira não alterada!');
        }
    }

    public function destroy($id)
    {
        $carrer = Carrer::find($id);
        try
        {
            $carrer->delete();
            return redirect('/Carreiras')->with('success', 'Carreira deletada!');
        } catch (QueryException $ex) {
            return redirect('/Carreiras')->with('failure', 'ERRO! Carreira não deletada!');
        }
    }


    public function ativarCarreira($id)
    { 
        $carrer = Carrer::find($id);

        if($carrer->carrer_active == true) $carrer->carrer_active = false;
        else if ($carrer->carrer_active == false) $carrer->carrer_active = true;
        else $carrer->carrer_active = false;
        try
        {
            $carrer->update();
            return redirect('/Carreiras')->with('success', 'Status alterado!');
          
         } catch (QueryException $ex) {
            return redirect('/Carreiras')->with('failure', 'ERRO! Status não alterado!');
         }

    }
}
