<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profession;
use Illuminate\Database\QueryException;

class ProfessionController extends Controller
{
    private $profession;
    public function __construct(Profession $profession) {
        $this->profession = $profession;
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
        return view('edits.profissaoEdit');
    
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

    public function PegaDados(Request $request) {
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->profession_id;
            $sub_dados[] = $row->profession_name;
            $sub_dados[] = ($row->profession_active) ? 'Ativa' : 'Inativa';
            $sub_dados[] = "<a href='".route('profession.edit', $row->profession_id)."' role='button' class='btn btn-success'><span class='glyphicon glyphicon-edit'></span></a>";
            $sub_dados[] = "<form method='POST' action='".route('profession.destroy', $row->profession_id)."'>".
                            method_field('DELETE').
                            csrf_field().
                            "<button type='submit' role='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></form>";
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
    private $order = ['profession_id','profession_name', 'profession_active', null, null ];
    
    public function CriarDataTable(Request $request)
    {
        $this->profession = Profession::select('profession_id','profession_name', 'profession_active');
        if($request->input('search.value') != null)
        {
            $this->profession->where('profession_name', 'like' ,'%', $request->input('search.value'));            
        }
        if($request->order!= null)
        {
            $this->profession->orderBy(array_get($this->order, $request->input('order.0.column')),
                                $request->input('order.0.dir'));
        }
        else
        {
            $this->profession->orderBy('profession_id', 'asc');
        }
        if($request->length != -1)
        {
            $this->profession->offset($request->start)->limit($request->length);
        }
        $query = $this->profession->get();
        return $query;
    }
    
    public function RegistrosFiltrados(Request $request)
    {
        $this->CriarDataTable($request);
        $query = $this->profession->count();
        return $query;
    }
    
    public function TodosRegistros()
    {
        $profession = Profession::all();
        return $profession->count();
    }

}
