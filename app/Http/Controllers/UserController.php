<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    private $regras = [
        'user_login' => 'bail|required|unique:users,user_login|max:100|min:5', 
        'user_hash' => 'bail|required|max:100|min:8' 
    ];
    private $messages = [
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
        $this->validate($request, $this->user->Regras(), $this->user->messages);
        $user = new User([
                'user_login' => $request->user_login
            ,   'user_hash' => Hash::make($request->user_hash)
            ,   'user_email'  => $request->user_email
                ]);
        try
        {
           $user->save();
           $user = User::where('user_email', '=', $request->user_email)->get();
           $request->session()->put('user', $user);
           redirect('cadastro')->with('success', 'Continue seu cadastro');
        } 
        catch (QueryException $ex) 
        {
            redirect('/')->with('failure', 'Não foi possivel cadastrar');
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
        $this->validate($request, $this->regras, $this->messages);
        $user = User::where('user_login', '=', $request->user_login)->count();
        if($user > 0)
        {
            $user = User::where('user_login', '=', $request->user_login)->first();
            if(Hash::check($request->user_hash, $user->user_hash))
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
