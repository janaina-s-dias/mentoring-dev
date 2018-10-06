<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    protected $table = ['professions'];
    protected $fillable = ['profession_name'];
    private $rules;
    public $message = [
        'profession_name.required' => 'A profissão é obrigatoria',
        'profession_name.unique' => 'Profissão ja existente',
        'profession_name.max' => 'Deve conter no maximo 50 caracteres',
    ];
    public function Rules($type = 'insert')
    {
        switch ($type) {
            case 'insert':
                return $this->rules = [
                    'profession_name' => 'bail|required|unique:professions,profession_descrition|max:50'
                ];
            case 'update':
                return $this->rules = [
                    'profession_name' => 'bail|required|max:50'
                ];
        }
    
    }

    var $select_columns = array ("profession_id", "profession_descrition", "profession_active");
    var $order_columns = array ("profession_id", "profession_descrition", "profession_active",  null, null); //null para botões de editar/excluir.
    
    function __construct() 
    {
        parent::__construct();
        $this->table = 'professions';
        
    }
    
    function criar_query()
    {
        $this->db->select($this->select_columns);
        $this->db->from($this->table);
        if(isset($_POST["search"]["value"]))
        {
            $this->db->like("profession_id", $_POST["search"]["value"]);
            $this->db->or_like("profession_descrition", $_POST["search"]["value"]);
            $this->db->or_like("profession_active", $_POST["search"]["value"]);
        }
        if(isset($_POST["order"]))
        {
            $this->db->order_by($this->order_columns[$_POST["order"]["0"]["column"]]
                    , $_POST["order"]["0"]["dir"]);
        }
        else
        {
            $this->db->order_by("profession_id", "desc");
        }
    }
    
            function criar_datatable()
            {
                $this->criar_query();
                if($_POST["length"] != -1)
                {
                $this->db->limit($_POST["length"], $_POST["start"]);
                }
                $query = $this->db->get();
                return $query->result();
            }
    
            function getFilteredData()
            {
                $this->criar_query();
                $query = $this->db->get();
                return $query->num_rows();
            }
        
            function getAllData()
            {
                $this->db->select("*");
                $this->db->from($this->table);
                return $this->db->count_all_results();
            }
    

}
