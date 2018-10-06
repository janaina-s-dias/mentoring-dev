<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Profession;

class ProfessionController extends Controller
{
    private $profession;
    public function __construct(Profession $profession) {
        $this->profession = $profession;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request) {
        $this->validate($request, $this->profession->Rules(), $this->profession->messages);
        $profession = new \App\Profession([
            'profession_name' => $request->profession_name
        ]);
        try {
            $profession->save();
            redirect('profession.index')->with('success', 'Profissão salva');
        } 
        catch (\Illuminate\Database\QueryException $ex) {
            redirect('profession.create')->with('failure', 'Não foi possivel cadastrar a profissão', $request);
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
        $profession = \App\Profession::find($id)->first();
        redirect('profession.index')->with('finded', $profession);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profession = \App\Profession::find($id)->first();
        return view('profession.editar')->with('finded', $profession);
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
        $this->validate($request, $this->profession->Rules('update'), $this->profession->messages);
        $profession = \App\Profession::find($id)->first();
        $profession->profession_name = $request->profession_descrition;
        try
        {
            $profession->update();
            redirect('profession.index')->with('success', 'Profissão alterada');
        } catch (\Illuminate\Database\QueryException$ex) {
            redirect('profession.editar')->with('failure', 'ERRO! Profissão não alterada');
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
        $profession = \App\Profession::find($id)->first();
        try
        {
            $profession->delete();
            redirect('profession.index')->with('success', 'Profissão deletada');
        } catch (\Illuminate\Database\QueryException$ex) {
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
    
    public function CriarQuery(Request $request)
    {
        $this->profession = \App\Profession::select($this->columnsSelect);
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
        $profession = \App\Profession::all();
        return $profession->count();
    }

}
