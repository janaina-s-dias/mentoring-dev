<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        if($users->user_knowledge)
        {
            $users->user_role = 2;
        }
        try
        {
           $users->update();
           Auth::login($users);
           return redirect('/')->with('success', 'Cadastrado com sucesso');
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
                Auth::login($user);
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
           Auth::login($user);
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
        $user = User::find($id);
        try
        {
            if(intval($id) != intval(Auth::user()->user_id))
            {
                $user->delete();
            }
            else
            {
                return redirect('/Usuarios')->with('failure', 'ERRO! Você não pode se auto-deletar do sistema');
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
            return redirect('/')->with('failure', 'Senha incorreta');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');        
    }
    

    
}