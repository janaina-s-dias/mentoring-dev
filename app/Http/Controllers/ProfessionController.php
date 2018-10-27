<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Profession;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class ProfessionController extends Controller
{
    private $profession;
    public function __construct(Profession $profession, Request $request) {
        $this->profession = $profession;
    }
    
    public function JsonPopular()
    {
        $profession = \App\Profession::where('profession_active', '=', '1')->get();
        $dados = array();
        foreach ($profession as $value) {
            $subarray = array();
            $subarray['profession_id'] = $value->profession_id;
            $subarray['profession_nome'] = $value->profession_name;
            $dados[]=$subarray;
        }
    return response()->json($dados);
    }

    public function store(Request $request) {
        $this->validate($request, $this->profession->Rules(), $this->profession->message);
        $profession = new Profession([
            'profession_name' => $request->profession_name,
            'profession_active' => $request->profession_active
        ]);
        try {
            $profession->save();
            return view('pageTipos')->with('success', 'Profissão salva!');
        } 
        catch (QueryException $ex) {
            return view('pageTipos')->with('failure', 'Não foi possivel cadastrar a profissão', $request);
        }
        
    }

    public function edit($id, Request $request)
    {
        $profession = Profession::find($id);
        $request->session()->put('profissao', $profession);
        return redirect('/EditarProfissao');
    
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->profession->Rules('update'), $this->profession->message);
        $profession = Profession::find($id);
        $profession->profession_name = $request->profession_name;
        $profession->profession_active = $request->profession_active;
        try
        {
            $profession->update();
            $request->session()->forget('profissao');
            return redirect('/Profissoes')->with('success', 'Profissão alterada!');
        } catch (QueryException $ex) {
            return redirect('/Profissoes')->with('failure', 'ERRO! Profissão não alterada!');
        }
        
    }

     //Função para alterar status do item
    public function ativar($id)
    { 
        $profession = Profession::find($id);
        
        if($profession->profession_active == true)
        {
            $profession->profession_active = false;
        }
        else if ($profession->profession_active == false)
        {
            $profession->profession_active = true;
        }
        else {
            $profession->profession_active = false;
        }

        try
        {
            $profession->update();
            return redirect('/Profissoes')->with('success', 'Status alterado!');
          
        } catch (QueryException $ex) {
            return redirect('/Profissoes')->with('failure', 'ERRO! Status não alterado!');
        }

    }

    public function destroy($id)
    {
        $profession = Profession::find($id);
        try
        {
            $profession->delete();
            return redirect('/Profissoes')->with('success', 'Profissão deletada!');
        } catch (QueryException $ex) {
            return redirect('/Profissoes')->with('failure', 'ERRO! Profissão não deletada!');
        }
    }


}
