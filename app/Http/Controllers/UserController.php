<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    private $user;
    function __construct(User $user) {
        $this->user = $user;
    }


        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, $this->user->Regras(), $this->user->mensagens);
        $users = new User([
                'user_login' => $request->user_login
            ,   'user_hash' => Hash::make($request->user_hash)
            ,   'user_email'  => $request->user_email
                ]);
        try
        {
           $users->save();
           $user = User::where('user_email', '=', $request->user_email)->get()->first();
           $request->session()->put('user', $user);
           return view('cadastroUsuario')->with('success', 'Continue seu cadastro');
        } 
        catch (QueryException $ex) 
        {
            redirect('/')->with('failure', 'Não foi possivel cadastrar');
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
           $user = User::where('user_email', '=', $request->user_email)->get()->first();
           $request->session()->flush();
           $request->session()->put('user', $user);
           return view('/')->with('success', 'Continue seu cadastro');
        } 
        catch (QueryException $ex) 
        {
            redirect('cadastro')->with('failure', 'Não foi possivel cadastrar');
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
        $user = User::find($id)->first();
        redirect('user.index')->with('finded', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id)->first();
        return view('user.editar')->with('finded', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSenha(Request $request, $id){
        $this->validate($request, $this->user->Regras('senha'), $this->user->mensagens);
        $user = UserController::find($id);
        if(Hash::check($request->get('user_hash-last'), $user->user_hash))
        {
            $user->user_hash = Hash::make($request->get('user_hash'));
            try
            {
                $user->update();
                redirect('senha')->with('success', 'Senha alterada com sucesso');
                
            } catch (QueryException $ex) {
                redirect('senha')->with('failure', 'Senha não alterada');
            }
        }
        else
        {
            redirect('senha')->with('failure', 'Senha antiga errada');
        }
    }
    
    public function update(Request $request, $id)
    {
        //
        {
        $this->validate($request, $this->user->Regras('update'), $this->user->mensagens);
        $user = User::find($id)->first();
        $user->user_login = $request->user_login;
        $user->user_hash = $request->user_hash;
        $user->user_cpf = $request->user_cpf;
        $user->user_nome = $request->user_nome;
        $user->user_rg = $request->user_rg;
        $user->user_email = $request->user_email;
        $user->user_telefone = $request->user_telefone;
        $user->user_celular = $request->user_celular;
        $user->user_knowledge = $request->user_knowledge;
        
        /*'user_login'
        ,   'user_hash'
        ,   'user_cpf'
        ,   'user_nome' 
        ,   'user_rg' 
        ,   'user_email' 
        ,   'user_telefone' 
        ,   'user_celular' 
        ,   'user_knowledge' 
        ,   'user_role' */
        
        
        try
        {
           $user->update();
           redirect('user.index')->with('success', 'informações alteradas');
        } catch (QueryException $ex) {
           redirect('user.editar')->with('failure', 'ERRO! informações não alteradas');
        }
        
    }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->first();
        try
        {
            $user->delete();
            redirect('user.index')->with('success', 'Usuário deletado');
        } catch (QueryException $ex) {
            redirect('user.editar')->with('failure', 'ERRO! Usuário não deletado');
        }
    }
    
    public function logar(Request $request)
    {
        $this->validate($request, $this->user->Regras('login'), $this->user->mensagens);
        $user = User::where('user_login', '=', $request->get('user_login_login'))->count();
        if($user > 0)
        {
            $user = User::where('user_login', '=', $request->get('user_login_login'))->first();
            if(Hash::check($request->get('user_hash_login'), $user->user_hash))
            {
                $request->session()->put('user', $user);
                return redirect('/');
            }
            else
            {
                return redirect('/')->with('error', 'Senha incorreta');            }
        }
        else
        {
            return redirect('/')->with('error', 'Usuario inexistente');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');        
    }
}
