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
        $this->validate($request, $this->carrer->Regras(), $this->subject->messages);
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

    public function PegaDadosCarreira(Request $request) {
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
             $sub_dados = array();
             $sub_dados[] = $row->carrer_id;
             $sub_dados[] = $row->carrer_name;
             $sub_dados[] = $row->carrer_active;
             $sub_dados[] = $row->fk_carrer_profession;
             $sub_dados[] = "<a href='' role='button' class='btn btn-success'><span class='glyphicon glyphicon-edit'></span></a>";
             $sub_dados[] = "<a href='' role='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></a>";
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
    private $order = ['carrer_id','carrer_name', 'carrer_active','fk_carrer_profession', null, null ];

    public function CriarQuery(Request $request)
    {
        $this->carrer = Carrer::select('carrer_id','carrer_name', 'carrer_active')
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
            $this->carrer->orderBy('carrer_id', 'desc');
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
