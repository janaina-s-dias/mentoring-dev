<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    private $contact;
    public function __construct(Contact $contact, Request $request) {
        $this->contact = $contact;
    }

    public function store(Request $request)
    { 
        $this->validate($request, $this->contact->rules, $this->contact->messages);
        $contact = new Contact([
            'contact_type' => $request->contact_type,
            'contact_description' => $request->contact_description,
            'fk_contact_user' => Auth::user()->user_id
        ]);
        
        try
        {
            $contact->save();
            return redirect('cadastroContato')->with('success', 'Contato cadastrado');
        } catch (QueryException $ex) {
            return redirect('cadastroContato')->with('failure', 'Contato não cadastrado');
        }
    }
    public function show($id)
    {
        $contato = Contact::where('fk_contact_user', $id)->get();
        $dados = array();
        foreach ($contato as $linha)
        {
            $subdados = array();
            $subdados['tipo'] = $linha->contact_type;
            $subdados['contato'] = $linha->contact_description;
            $subdados['editar'] = "<a href='".route('contact.edit', $linha->contact_id)."' role='button' class='btn btn-success' data-toggle='tooltip' title='Alterar'><span class='glyphicon glyphicon-edit'></span></a>";
            $subdados['excluir'] = "<form method='POST' action='".route('contact.destroy', $linha->contact_id)."'>".
                            method_field('DELETE').
                            csrf_field().
                            "<button type='submit' role='button' class='btn btn-danger' data-toggle='tooltip' title='Deletar'><span class='glyphicon glyphicon-trash'></span></button></form>";
            $dados[] = $subdados;
        }
        echo json_encode($dados);
    }
    public function edit($id)
    { 
        $contato = Contact::find($id);
        
        return view('edits.contato', compact('contato'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->contact->rulesA, $this->contact->messages);
        $contact = Contact::find($id);
        $contact->contact_type = $request->contact_type;
        $contact->contact_description = $request->contact_description;
        
        try
        {
            $contact->update();
            return back()->with('success', 'Contato alterado');
        } catch (QueryException $ex) {
            return back()->with('failure', 'Contato não alterado');
        }        
    }

    public function destroy($id)
    {
        $contato = Contact::find($id);
        try {
            $contato->delete();
            return back()->with('success', 'Deletado com sucesso');
        } catch (QueryException $ex) {
            return back()->with('failure', 'Erro ao deletar');
        }
    }

    public function PegaDadosContato(Request $request){
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->contact_id;
            $sub_dados[] = $row->contact_type;
            $sub_dados[] = $row->contact_description;
            $sub_dados[] = $row->user_nome; //Tabela estrangeira
            $sub_dados[] = "<a href='".route('contact.edit', $row->contact_id)."' role='button' class='btn btn-success' data-toggle='tooltip' title='Alterar'><span class='glyphicon glyphicon-edit'></span></a>";
            $sub_dados[] = "<form method='POST' action='".route('contact.destroy', $row->contact_id)."'>".
                            method_field('DELETE').
                            csrf_field().
                            "<button type='submit' role='button' class='btn btn-danger' data-toggle='tooltip' title='Deletar'><span class='glyphicon glyphicon-trash'></span></button></form>";
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

    private $order = ['contact_id','contact_type', 'contact_description','user_nome', null, null ];

    public function CriarQuery(Request $request)
    {
        $this->contact = Contact::select('contact_id','contact_type', 'contact_description', 'user_nome')
            ->join('users', 'user_id', '=', 'fk_contact_user');
           
       
        if($request->input('search.value') != null)
        {
            $this->contact->where('user_nome', 'like' ,'%', $request->input('search.value'));            
        }
        if($request->order!= null)
        {
            $this->contact->orderBy(array_get($this->order, $request->input('order.0.column')),
                                $request->input('order.0.dir'));
        }
        else
        {
            $this->contact->orderBy('contact_id', 'asc');
        }
    }

    public function CriarDataTable(Request $request)
    {
        $this->CriarQuery($request);
        if($request->length != -1)
        {
            $this->contact->offset($request->start)->limit($request->length);
        }
        $query = $this->contact->get();
        return $query;
    }

    public function RegistrosFiltrados(Request $request)
    {
        $this->CriarQuery($request);
        $query = $this->contact->count();
        return $query;
    }
    
    public function TodosRegistros()
    {
        $contact = Contact::all();
        return $contact->count();
    }




}
