<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Database\QueryException;


class ContactController extends Controller
{
    private $contact;
    public function __construct(Contact $contact, Request $request) {
        $this->contact = $contact;
    }

    public function store(Request $request)
    { }

    public function edit($id, Request $request)
    { }

    public function update(Request $request, $id)
    { }

    public function destroy($id)
    { }

    public function PegaDadosContato(Request $request){
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->contact_id;
            $sub_dados[] = $row->contact_type;
            $sub_dados[] = $row->contact_description;
            $sub_dados[] = $row->user_nome; //Tabela estrangeira
            $sub_dados[] = "<a href='".route('contact.edit', $row->contact_id)."' role='button' class='btn btn-success'><span class='glyphicon glyphicon-edit'></span></a>";
            $sub_dados[] = "<form method='POST' action='".route('contact.destroy', $row->contact_id)."'>".
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
