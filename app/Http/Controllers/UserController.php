<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    private $rules = [
        'user_login-login' => 'bail|required', 
        'user_hash-login' => 'bail|required' 
    ];
    private $messages = [
        'user_login-login.required' => 'Usuario é obrigatorio',
        'user_hash-login.required' => 'Senha obrigatoria',
    ];
    private $regras = [
        'user_login' => 'bail|required|unique:users,user_login|max:100|min:5', 
        'user_hash' => 'bail|required|max:100|min:8|confirmed',
        'user_email' => 'bail|required|email|max:100|min:20|unique:users,user_email'
    ];
    private $mensagem = [
        'user_login.required' => 'Usuario é obrigatorio',
        'user_login.unique' => 'Usuario ja utilizado',
        'user_login.max' => 'Usuario muito grande',
        'user_login.min' => 'Usuario muito pequeno',
        'user_hash.required' => 'Senha obrigatoria',
        'user_hash.min' => 'Senha muito pequena',
        'user_hash.max' => 'Senha muito grande'
    ];
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
        $this->validate($request, $this->regras, $this->mensagem);
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
    
    public function store2(Request $request, $id)
    {
        $this->validate($request, $this->user->Regras(), $this->user->messages);
        $users = User::find($id);
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
        //
        {
        $this->validate($request, $this->user->Regras('update'), $this->user->messages);
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
           // redirect('profession.index')->with('success', 'Profissão alterada');
        } catch (QueryException $ex) {
            //redirect('profession.editar')->with('failure', 'ERRO! Profissão não alterada');
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
        //
    }
    
    public function logar(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);
        $user = User::where('user_login', '=', $request->get('user_login-login'))->count();
        if($user > 0)
        {
            $user = User::where('user_login', '=', $request->get('user_login-login'))->first();
            if(Hash::check($request->get('user_hash-login'), $user->user_hash))
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
