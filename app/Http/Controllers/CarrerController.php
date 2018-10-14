<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrer;
use Illuminate\Database\QueryException;

class CarrerController extends Controller
{
    private $carrer;
    
    function __construct(Carrer $carrer) {
        $this->carrer = $carrer;
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
            return redirect('/Carreiras')->with('success', 'Carreira salva');
        } 
        catch (QueryException $ex) {
            return redirect('/Carreiras')->with('failure', 'Não foi possivel cadastrar a carreira', $request);
        }
    }
    
    public function edit($id, Request $request)
    {
        $carrer = Carrer::find($id)->first();
        $request->session()->put('carreira', $carrer);
        return view('edits.carreiraEdit');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->carrer->Regras('update'), $this->carrer->messages);
        $carrer = Carrer::find($id)->first();
        $carrer->carrer_name = $request->carrer_name;
        $carrer->carrer_active = $request->carrer_active;
        $carrer->fk_carrer_profession = $request->fk_carrer_profession;
        try
        {
            $carrer->update();
            $request->session()->forget('carreira');
            return redirect('/Carreiras')->with('success', 'Carreira alterada');
        } catch (QueryException $ex) {
            return redirect('/Carreiras')->with('failure', 'ERRO! Carreira não alterada');
        }
    }

    public function destroy($id)
    {
        $carrer = Carrer::find($id)->first();
        try
        {
            $carrer->delete();
            return redirect('/Carreiras')->with('success', 'Carreira deletada');
        } catch (QueryException $ex) {
            return redirect('/Carreiras')->with('failure', 'ERRO! Carreira não deletada');
        }
    }

    public function PegaDadosCarreira(Request $request) {
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
             $sub_dados = array();
             $sub_dados[] = $row->carrer_id;
             $sub_dados[] = $row->carrer_name;
             $sub_dados[] = $row->profession_name;
             $sub_dados[] = ($row->carrer_active) ? 'Ativa' : 'Inativa';
             $sub_dados[] = "<a href='".route('carrer.edit', $row->carrer_id)."' role='button' class='btn btn-success'><span class='glyphicon glyphicon-edit'></span></a>";
             $sub_dados[] = "<form method='POST' action=".route('carrer.destroy', $row->carrer_id)."'>".
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
    private $order = ['carrer_id','carrer_name', 'carrer_active','profession_name', null, null ];

    public function CriarQuery(Request $request)
    {
        $this->carrer = Carrer::select('carrer_id','carrer_name', 'carrer_active', 'profession_name')
            ->join('professions', 'profession_id', '=', 'fk_carrer_profession');
           
       
        if($request->input('search.value') != null)
        {
            $this->carrer->where('carrer_name', 'like' ,'%', $request->input('search.value'));            
        }
        if($request->order!= null)
        {
            $this->carrer->orderBy(array_get($this->order, $request->input('order.0.column')),
                                $request->input('order.0.dir'));
        }
        else
        {
            $this->carrer->orderBy('carrer_id', 'asc');
        }
    }
    
    public function CriarDataTable(Request $request)
    {
        $this->CriarQuery($request);
        if($request->length != -1)
        {
            $this->carrer->offset($request->start)->limit($request->length);
        }
        $query = $this->carrer->get();
        return $query;
    }
    
    public function RegistrosFiltrados(Request $request)
    {
        $this->CriarQuery($request);
        $query = $this->carrer->count();
        return $query;
    }
    
    public function TodosRegistros()
    {
        $carrer = Carrer::all();
        return $carrer->count();
    }
}
