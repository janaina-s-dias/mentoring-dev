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
}
