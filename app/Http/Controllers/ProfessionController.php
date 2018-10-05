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
        $this->validate($request, $this->profession->Rules(), $this->profession->messages);
        $attributes = [
            'profession_descrition' => $request->get('profession_descrition')
        ];
        $retorno = $this->profession->Store($attributes);
        redirect()->with('mensagem', $retorno);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $attributes = [
            'profession_descrition' => $request->get('profession_descrition')
        ];
        $retorno = $this->profession->Update($attributes, $id);
        redirect()->with('mensagem', $retorno);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $retorno = $this->profession->Destroy($id);
        redirect()->with('mensagem', $retorno);
    }


    public function PegaDados() {
        $pegadados = $this->profession_model->criar_datatable();
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->profession_id;
            $sub_dados[] = $row->profession_descrition;
            $sub_dados[] = $row->profession_active;
            $sub_dados[] = "<a href='".base_url('profession/editar')."/".$row->profession_id."' role='button' class='btn btn-success'><span class='glyphicon glyphicon-edit'></span></a>";
            $sub_dados[] = "<a href='".base_url('profession/excluir')."/".$row->profession_id."' role='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></a>";
            $dados[] = $sub_dados;
        }
        
        $output = array (
            "draw"  => intval($_POST["draw"]),
            "recordsTotal" => $this->categoria_model->getAllData(), 
            "recordsFiltered" => $this->categoria_model->getFilteredData(),
            "data" => $dados
        );
        echo json_encode($output);
    }


}
