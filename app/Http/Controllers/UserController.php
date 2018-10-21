<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $user;
    function __construct(User $user, Request $request) {
        $this->user = $user;
        
    }

    public function index()
    {
        return view('index');
    }

    public function create()
    {
        
    }

    public function store(Request $request) {
        $this->validate($request, $this->user->Regras(), $this->user->mensagens);
        $users = new User([
                'user_login' => $request->login
            ,   'user_hash' => Hash::make($request->hash)
            ,   'user_email'  => $request->user_email
                ]);
        try
        {
           $users->save();
           Auth::attempt(['user_login'=>$request->login, 'user_hash' => $request->hash]);
           return redirect('cadastro')->with('success', 'Continue seu cadastro');
        } 
        catch (Exception $ex) 
        {
            return redirect('/')->with('failure', 'Não foi possivel cadastrar!');
        }
    }
    
    public function store2(Request $request)
    {
        
        $this->validate($request, $this->user->Regras('insert2'), $this->user->mensagens);
        $users = User::find($request->user_id);
        $users->user_nome =         $request->user_nome;
        $users->user_rg =           $request->user_rg;
        $users->user_cpf  =         $request->user_cpf;
        $users->user_telefone  =    $request->user_telefone;
        $users->user_celular  =     $request->user_celular;
        $users->user_knowledge  =   $request->user_knowledge;
        try
        {
           $users->update();
           return redirect('/')->with('success', 'Continue seu cadastro');
        } 
        catch (QueryException $ex) 
        {
            return redirect('cadastro')->with('failure', 'Não foi possivel cadastrar!');
        }
    }

    public function updateSenha(Request $request, $user_id){
        $user = User::find($user_id);
        $this->validate($request, $this->user->Regras('senha'), $this->user->mensagens);        
        if($request->get('new_user_hash') != $request->get('new_user_hash_confirmation'))
            {
            return view('/alterarSenha')->with('failure', 'Senhas diferentes!');            
        } else {
            if(Hash::check($request->get('user_hash'), $user->user_hash))
        {
            $user->user_hash = Hash::make($request->get('new_user_hash'));
            try
            {
                $user->update();
                return redirect('alterarSenha')->with('success', 'Senha alterada com sucesso!');
                
            } catch (QueryException $ex) {
                return redirect('alterarSenha')->with('failure', 'Senha não alterada!');
            }
        } else {
            return redirect('alterarSenha')->with('failure', 'Senha antiga errada!');
        }
            
        }
    }
    
    
    
    public function update(Request $request, $id)
    {
        
        $this->validate($request, $this->user->Regras('update'), $this->user->mensagens);
        $user = User::find($id);
        $user->user_login = $request->user_login;
        $user->user_cpf = $request->user_cpf;
        $user->user_nome = $request->user_nome;
        $user->user_rg = $request->user_rg;
        $user->user_email = $request->user_email;
        $user->user_telefone = $request->user_telefone;
        $user->user_celular = $request->user_celular;
        $user->user_knowledge = $request->user_knowledge;
        try
        {
           $user->update();
           return redirect('/alterarPerfil')->with('success', 'Informações alteradas!');
        } catch (QueryException $ex) {
           return redirect('/alterarPerfil')->with('failure', 'ERRO! Informações não alteradas!');
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $userSession = $request->session()->get('user');
        $user = User::find($id);
        try
        {
            $user->delete();
            if($id == $userSession->user_id)
            {
                $request->session()->flush();
            }
            return redirect('/Usuarios')->with('success', 'Usuário deletado!');
        } catch (QueryException $ex) {
            return redirect('/Usuarios')->with('failure', 'ERRO! Usuário não deletado!');
        }
    }
    
    public function logar(Request $request)
    {
        $this->validate($request, $this->user->Regras('login'), $this->user->mensagens);
        $credenciais = $request->only('user_login', 'user_hash');
        if(Auth::attempt($credenciais))
        {
            return redirect('/');
        }
        else
        {
            return redirect('/')->with('failure', 'Usuario inexistente!');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');        
    }
    
    public function PegaDadosUsuario(Request $request) {
        $pegadados = $this->CriarDataTable($request);
        $dados = array();
        foreach ($pegadados as $row) {
             $sub_dados = array();
             $sub_dados[] = $row->user_id;
             $sub_dados[] = $row->user_nome;
             $sub_dados[] = $row->user_login;
             $sub_dados[] = $row->user_email;
             $sub_dados[] = $row->user_cpf;
             $sub_dados[] = $row->user_rg;
             $sub_dados[] = $row->user_telefone;
             $sub_dados[] = $row->user_celular;
             $sub_dados[] = ($row->user_knowledge) ? 'Sim' : 'Não';
             //$sub_dados[] = "<button id='assuntos' value='".$row->user_id."' role='button' class='btn btn-primary'><span class='glyphicon glyphicon-eye-open'></span></a>";
             $sub_dados[] = "<form method='POST' action=".route('user.destroy', $row->user_id)."'>".
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
    private $order = ['user_id','user_nome', 'user_login','user_email', 'user_cpf', 'user_rg', 'user_telefone', 'user_celular', 'user_knowledge', null, null, null ];

    public function CriarQuery(Request $request)
    {
        $this->user = User::select('user_id','user_nome', 'user_login','user_email', 'user_cpf', 'user_rg', 'user_telefone', 'user_celular', 'user_knowledge');
        if($request->input('search.value') != null)
        {
            $this->carrer->where('user_name', 'like' ,'%', $request->input('search.value'));            
        }
        if($request->order!= null)
        {
            $this->user->orderBy(array_get($this->order, $request->input('order.0.column')),
                                $request->input('order.0.dir'));
        }
        else
        {
            $this->user->orderBy('user_id', 'asc');
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
        $user = User::all();
        return $user->count();
    }
    
}