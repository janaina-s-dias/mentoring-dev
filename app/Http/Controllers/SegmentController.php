<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Segment;

class SegmentController extends Controller
{
    private $segment;
    public function __construct(Segment $segment) {
        $this->segment = $segment;
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
        $this->validate($request, $this->segment->Rules(), $this->segment->messages);
        $attributes = [
            'segment_descrition' => $request->get('segment_descrition')
        ];
        $retorno = $this->segment->Store($attributes);
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
        $this->validate($request, $this->segment->Rules('update'), $this->segment->messages);
        $attributes = [
            'segment_descrition' => $request->get('segment_descrition')
        ];
        $retorno = $this->segment->Update($attributes, $id);
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
        $retorno = $this->segment->Destroy($id);
        redirect()->with('mensagem', $retorno);
    }
}
