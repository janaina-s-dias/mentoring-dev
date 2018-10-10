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

    public function index()
    {
        //retorna a home do profession
    }

    public function create()
    {
        //retorna a tela de cadastro do profession
    }

    public function store(Request $request) {
        $this->validate($request, $this->profession->Rules(), $this->profession->messages);
        $profession = new Profession([
            'profession_name' => $request->profession_name
        ]);
        try {
            $profession->save();
            redirect('profession.index')->with('success', 'Profissão salva');
        } 
        catch (QueryException $ex) {
            redirect('profession.create')->with('failure', 'Não foi possivel cadastrar a profissão', $request);
        }
        
    }

    public function show($id)
    {
        $profession = Profession::find($id)->first();
        redirect('profession.index')->with('finded', $profession);
    }

    public function edit($id)
    {
        $profession = Profession::find($id)->first();
        return view('profession.editar')->with('finded', $profession);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->profession->Rules('update'), $this->profession->messages);
        $profession = Profession::find($id)->first();
        $profession->profession_name = $request->profession_descrition;
        try
        {
            $profession->update();
            redirect('profession.index')->with('success', 'Profissão alterada');
        } catch (QueryException $ex) {
            redirect('profession.editar')->with('failure', 'ERRO! Profissão não alterada');
        }
        
    }

    public function destroy($id)
    {
        $profession = Profession::find($id)->first();
        try
        {
            $profession->delete();
            redirect('profession.index')->with('success', 'Profissão deletada');
        } catch (QueryException $ex) {
            redirect('profession.editar')->with('failure', 'ERRO! Profissão não deletada');
        }
    }

    public function PegaDados(Request $request) {
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->profession_name;
            $sub_dados[] = "<a href='". route('profession/edit', $row->profession_id)."' role='button' class='btn btn-success'><span class='glyphicon glyphicon-edit'></span></a>";
            $sub_dados[] = "<a href='". route('profession/delete', $row->profession_id)."' role='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></a>";
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
    public function CriarQuery(Request $request)
    {
        $this->profession = Profession::select('profession_id','profession_name', 'profession_active');
        if(isset($request->search->value))
        {
            $this->profession->where('profession_name', 'like' ,'%', $request->search->value);            
        }
        if(isset($request->order))
        {
            $this->profession->orderBy(array_get($this->order, $request->input('order.0.column')),
                                $request->input('order.0.dir'));
        }
        else
        {
            $this->profession->orderBy('profession_id', 'desc');
        }
    }
    
    public function CriarDataTable(Request $request)
    {
        $this->CriarQuery($request);
        if($request->length != -1)
        {
            $this->profession->take($request->lenght)->skip($request->start);
        }
        $query = $this->profession->get();
        return $query;
    }
    
    public function RegistrosFiltrados(Request $request)
    {
        $this->CriarQuery($request);
        $query = $this->profession->count();
        return $query;
    }
    
    public function TodosRegistros()
    {
        $profession = Profession::all();
        return $profession->count();
    }

}
