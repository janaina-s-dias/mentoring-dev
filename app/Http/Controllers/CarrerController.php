<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Carrer;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;


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

    public function PegaDadosCarreira(Request $request) {
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
             $sub_dados = array();
             $sub_dados[] = $row->carrer_id;
             $sub_dados[] = $row->carrer_name;
             $sub_dados[] = $row->profession_name;
             $sub_dados[] = ($row->carrer_active) ? 'Ativa' : 'Inativa';

             $sub_dados[] = ($row->carrer_active) ? 
            
             "<form method='POST' action='".route('ativarcarrer', $row->carrer_id)."'>".
                 method_field('PATCH').
                 @csrf_field().
             "<button type='submit' role='button' class='btn btn-warning' data-toggle='tooltip' title='Inativar Item'><i class='fa fa-times'></i></button> </span></button> </form>" : 
 
             "<form method='POST' action='".route('ativarcarrer', $row->carrer_id)."'>".
                 method_field('PATCH').
                 @csrf_field()."<button type='submit' role='button' class='btn btn-success' data-toggle='tooltip' title='Ativar Item'><i class='fa fa-check'></i></button> </button></form>";
             

             $sub_dados[] = "<a href='".route('carrer.edit', $row->carrer_id)."' role='button' class='btn btn-primary' data-toggle='tooltip' title='Alterar'><span class='glyphicon glyphicon-edit'></span></a>";
             $sub_dados[] = "<form method='POST' action='".route('carrer.destroy', $row->carrer_id)."'>".
                            method_field('DELETE').
                            csrf_field().
                            "<button type='submit' role='button' class='btn btn-danger' data-toggle='tooltip' title='Deletar Item'><span class='glyphicon glyphicon-trash'></span></button></form>";
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
