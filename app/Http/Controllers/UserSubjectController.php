<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserSubject;
use Illuminate\Database\QueryException;

class UserSubjectController extends Controller
{
    private $us;
    public function __construct(UserSubject $us) {
        $this->us = $us;
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
        $this->validate($request, $this->us->rules, $this->us->messages);
        $us = new UserSubject([
            'fk_user_subject' => $request->fk_user_subject,
            'fk_subject_user' => $request->fk_subject_user
        ]);
        $existe = UserSubject::where('fk_user_subject','=',$request->fk_user_subject)
                ->where('fk_subject_user','=',$request->fk_subject_user)->count();
        if($existe == 0)
        {
            try {
                $us->save();
                return redirect('/cadastroAssunto')->with('success', 'Assunto inserido em seus interesses');
            } catch (QueryException $exc) {
                return redirect('/cadastroAssunto')->with('failure', 'Assunto não inserido em seus interesses');
            }
        }
        else
        {
            return redirect('/cadastroAssunto')->with('failure', 'Assunto já cadastrado em seus interesses');
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
        $us = UserSubject::join('subjects', 'fk_user_subject', '=', 'subject_id')
                         ->join('users','fk_subject_user','=','user_id')
                         ->where('user_id', $id)->get();
         redirect('perfil')->with('assuntos', $us);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //não tem isso
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
        //não tem isso
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id1,$id2)
    {
        $us = UserSubject::where('fk_user_subject', '=', $id1)->
                           where('fk_subject_user', '=', $id2);
        try {
            $us->delete();
            redirect('assuntosUser')->with('success', 'Assunto removido dos interesses');
        } catch (QueryException $exc) {
            redirect('assuntosUser')->with('failure', 'Assunto não removido dos interesses');
        }
    }
    public function PegaDadosUsuario(Request $request) {
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
             $sub_dados = array();
             $sub_dados[] = $row->user_name;
             $sub_dados[] = $row->subject_name;
             $sub_dados[] = $row->carrer_name;
             $sub_dados[] = $row->profession_name;
             $sub_dados[] = "<form method='POST' action=".route('user.destroy', $row->fk_subject_user, $row->fk_user_subject)."'>".
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
    private $order = ['user_name', 'subject_name','carrer_name', 'profession_name', null ];

    public function CriarQuery(Request $request)
    {
        $this->user = UserSubject::select('*')
                ->join('users', 'user_id', '=', 'fk_subject_user')
                ->join('subjects', 'subject_id', '=', 'fk_user_subject')
                ->join('carrers', 'carrer_id', '=', 'fk_subject_carrer')
                ->join('professions', 'profession_id', '=', 'fk_carrer_profession');
        if($request->input('search.value') != null)
        {
            $this->carrer->where('user_name', 'like' ,'%', $request->input('search.value'));            
            $this->carrer->Orwhere('subject_name', 'like' ,'%', $request->input('search.value'));            
            $this->carrer->Orwhere('carrer_name', 'like' ,'%', $request->input('search.value'));            
            $this->carrer->Orwhere('profession_name', 'like' ,'%', $request->input('search.value'));            
        }
        if($request->order!= null)
        {
            $this->user->orderBy(array_get($this->order, $request->input('order.0.column')),
                                $request->input('order.0.dir'));
        }
        else
        {
              $this->user->orderBy('user_id', 'desc'); //troquei o created_at por user_id na coluna de ordenação, pois estava retornando violação do SQL State
        }
    }
    
    public function CriarDataTable(Request $request)
    {
        $this->CriarQuery($request);
        if($request->length != -1)
        {
            $this->user->offset($request->start)->limit($request->length);
        }
        $query = $this->user->get();
        return $query;
    }
    
    public function RegistrosFiltrados(Request $request)
    {
        $this->CriarQuery($request);
        $query = $this->user->count();
        return $query;
    }
    
    public function TodosRegistros()
    {
        $user = UserSubject::all();
        return $user->count();
    }
}
