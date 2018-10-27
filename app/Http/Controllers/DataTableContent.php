<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Content;

class DataTableContent extends Controller
{
        public function PegaDadosConteudo(Request $request) {
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->subject_name;
            $sub_dados[] = $row->content_title;  
            $sub_dados[] = $row->content_type;
            $sub_dados[] = 
        
           
            "<a href='".route('content.show', $row->content_id)."' role='button' class='btn btn-success' data-toggle='tooltip' title='Visualizar'><span>Ver Conteúdo</span></a>" ;  
            
            $sub_dados[] = 
            "<a href='".route('content.edit', $row->content_id)."' role='button' class='btn btn-primary' data-toggle='tooltip' title='Alterar'>Editar</a>";

            $sub_dados[] = 
        
            "<form method='POST' action='".route('content.destroy', $row->content_id)."'>". 
             method_field('DELETE').
                 @csrf_field().
            "<button type='submit' role='button' class='btn btn-danger' data-toggle='tooltip' title='Editar'><span>Excluir</span></button> </form>" ;  

            
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
    private $order = ['subject_name','content_title', 'content_type', null];

   
    public function CriarQuery(Request $request)
    {
         
        $this->content = Content::select('content_id','content_title','content_type', 'fk_content_knowledge', 'subject_name')
            ->join('knowledges', 'knowledge_id', '=', 'fk_content_knowledge')
                ->join('subjects', 'subject_id', '=', 'fk_knowledge_subject');
                 
    
        if($request->input('search.value') != null)
        {
            $this->content->where('content_title', 'like' ,'%', $request->input('search.value'));            
        }
        if($request->order!= null)
        {
            $this->content->orderBy(array_get($this->order, $request->input('order.0.column')),
                                $request->input('order.0.dir'));
        }
        else
        {
            $this->content->orderBy('content_title', 'asc');
        }
    }
    

    public function CriarDataTable(Request $request)
    {
        $this->CriarQuery($request);
        if($request->length != -1)
        {
            $this->content->offset($request->start)->limit($request->length);
        }
        $query = $this->content->get();
        return $query;
    }
    
    public function RegistrosFiltrados(Request $request)
    {
        $this->CriarQuery($request);
        $query = $this->content->count();
        return $query;
    }

    public function TodosRegistros()
    {
        $content = Content::all();
        return $content->count();
    }

}
