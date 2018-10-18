<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('cadastro', function(Request $request)
{
    if($request->session()->exists('user'))
    {
        return view('cadastroUsuario');
    }
    else
    {
        return view('login');
    }
});

Route::get('/', function(Request $request){
    if($request->session()->exists('user'))
    {
        $user = $request->session()->get('user');
        if($user->user_nome == null || $user->user_cpf == null || $user->user_rg == null) return view('cadastroUsuario');
        else return view('home');
    }
    else
    {
        return view('login');
    }
        
});

Route::get('perfil', function(Request $request){
    if($request->session()->exists('user'))
    {
        $user = $request->session()->get('user');
        if($user->user_nome == null || $user->user_cpf == null || $user->user_rg == null) return view('cadastroUsuario');
        else return view('perfil');
    }
    else
    {
        return view('login');
    }
        
})->name('perfil');

Route::get('cadastroAssunto', function(Request $request){
    if($request->session()->exists('user'))
    {
        $user = $request->session()->get('user');
        if($user->user_nome == null || $user->user_cpf == null || $user->user_rg == null) return view('cadastroUsuario');
        else return view('cadastroAssunto');
    }
    else
    {
        return view('login');
    }
        
});

Route::get('alterarPerfil', function(Request $request){
    if($request->session()->exists('user'))
    {
        $user = $request->session()->get('user');
        if($user->user_nome == null || $user->user_cpf == null || $user->user_rg == null) return view('cadastroUsuario');
        else return view('alterarPerfil');
    }
    else
    {
        return view('login');
    }
        
});

Route::get('alterarSenha', function(Request $request){
    if($request->session()->exists('user'))
    {
        $user = $request->session()->get('user');
        if($user->user_nome == null || $user->user_cpf == null || $user->user_rg == null) return view('cadastroUsuario');
        else return view('alterarSenha');
    }
    else
    {
        return view('login');
    }
        
});

Route::post('/inserirUsuario', 'UserController@store')->name('inserir');
Route::post('/inserirUsuario2', 'UserController@store2')->name('inserirUser');
Route::post('/alterandoUsuario', 'UserController@update')->name('atualizarUsuario');
Route::post('/logar', 'UserController@logar')->name('acessar');
Route::get('/sair', 'UserController@logout')->name('sair');
Route::post('/pegaDados', 'ProfessionController@PegaDados')->name('pegaDados');
Route::post('/pegaDadosCarreira', 'CarrerController@PegaDadosCarreira')->name('pegaDadosCarreira');
Route::post('/pegaDadosAssunto', 'SubjectController@PegaDadosAssunto')->name('pegaDadosAssunto');
Route::post('/pegaDadosUsuario', 'UserController@PegaDadosUsuario')->name('pegaDadosUsuario');
Route::post('/pegaDadosUsuarioAssunto', 'UserSubjectController@PegaDadosUsuarioAssunto')->name('pegaDadosUsuarioAssunto');
Route::post('/pegaDadosContato', 'ContactController@PegaDadosContato')->name('pegaDadosContato');
Route::resource('usersubject', 'UserSubjectController');
Route::resource('subject', 'SubjectController');
Route::resource('carrer', 'CarrerController');
Route::resource('profession', 'ProfessionController');
Route::resource('user', 'UserController');
Route::resource('contact', 'ContactController');

Route::post('/alterandoSenha/{user_id}', 'UserController@updateSenha')->name('alterarSenha'); //teste
Route::delete('user/{user}/subject/{subject}', 'UserSubjectController@deletar')->name('usersubject.deletar'); //teste
        

Route::get('/profissao', function(){
    $profession = \App\Profession::where('profession_active', '=', '1')->get();
    $dados = array();
    foreach ($profession as $value) {
        $subarray = array();
        $subarray['profession_id'] = $value->profession_id;
        $subarray['profession_nome'] = $value->profession_name;
        $dados[]=$subarray;
    }
   return Response::json($dados);
    
});

Route::get('/carreira', function(Request $request){
    $profession = $request->get('profissao');
    $carrer = \App\Carrer::where('fk_carrer_profession', '=', $profession)->
    							where('carrer_active', '=', '1')->get();
    $dados = array();
    foreach ($carrer as $value) {
        $subarray = array();
        $subarray['carrer_id'] = $value->carrer_id;
        $subarray['carrer_nome'] = $value->carrer_name;
        $dados[]=$subarray;
    }
    return Response::json($dados);
    
});

Route::get('/assunto', function(Request $request){
    $carrer = $request->get('carreira');
    $subject = \App\Subject::where('fk_subject_carrer','=', $carrer)
    							->where('subject_active', '=', '1')->get();
    $dados = array();
    foreach ($subject as $value) {
        $subarray = array();
        $subarray['subject_id'] = $value->subject_id;
        $subarray['subject_nome'] = $value->subject_name;
        $dados[]=$subarray;
    }
    return Response::json($dados);
    
});

Route::get('/userassunto', function(Request $request){
    $user = $request->get('user');
    $userSubject = \App\UserSubject::join('subjects', 'fk_user_subject', '=', 'subject_id')
            ->where('fk_subject_user', '=', $user);
    $dados = array();
    foreach ($userSubject as $value) {
        $subdados = array();
        $subdados['subject_name'] = $value->subject_name;
        $dados[] = $subdados;
    }
    return Response::json($dados);
});



Route::get('tables', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('table');
    }
    else
    {
        return view('login');
    }
});

Route::get('forms', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('form');
    }
    else
    {
        return view('login');
    }
});


Route::get('charts', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev') return "<h1 style='color: red;'>Você não tem permissã para acessar essa pagina</h1>";
        else return view('mcharts');
    }
    else
    {
        return view('login');
    }
});

Route::get('blank', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev') return "<h1 style='color: red;'>Você não tem permissã para acessar essa pagina</h1>";
        else return view('blank');
    }
    else
    {
        return view('login');
    }
});

Route::get('panel', function(Request $request){
    
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev') return "<h1 style='color: red;'>Você não tem permissã para acessar essa pagina</h1>";
        else return view('panel');
    }
    else
    {
        return view('login');
    }

});

Route::get('collapse', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('collapse');
    }
    else
    {
       return view('login');
    }
});

Route::get('documentation', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('documentation');
    }
    else
    {        return view('login');
    }
});

Route::get('icons', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('icons');
    }
    else
    {
       return view('login');
    }
});

Route::get('notifications', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('notifications');
    }
    else
    {        return view('login');
    }
});

Route::get('panels', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('panel');
    }
    else
    {
        return view('login');
    }
});

// Route::get('', function(){
//     return view('progressbars');
// });

Route::get('stats', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('stats');
    }
    else
    {
        return view('login');
    }
});

Route::get('typography', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('typography');
    }
    else
    {
       return view('login');
    }
});

Route::get('buttons', function(Request $request){
  if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('buttons');
    }
    else
    {
        return view('login');
    }
});

Route::get('grid', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('grid');
    }
    else
    {
        return view('login');
    }
});


Route::get('admin', function(Request $request){
    if($request->session()->exists('user'))    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev' && $user->user_role != 'admin' && $user->user_role != 'moderador') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('layouts.dashboardAdmin');
    }
    else
    {
        $user = $request->session()->get('user');
        if($user->user_role != 'dev' && $user->user_role != 'admin' && $user->user_role != 'moderador') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('login');
    }
});

Route::get('Profissoes', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev' && $user->user_role != 'admin' && $user->user_role != 'moderador') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('pageTipos');
    }
    else
    {
        return view('login');
    }
})->name('Profissoes');


Route::get('Carreiras', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev' && $user->user_role != 'admin' && $user->user_role != 'moderador') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('manterCarreira');
    }
    else
    {
        return view('login');
    }
});


Route::get('Assuntos', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev' && $user->user_role != 'admin' && $user->user_role != 'moderador') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('manterAssunto');
    }
    else
    {
        return view('login');
    }
});

Route::get('Usuarios', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev' && $user->user_role != 'admin' && $user->user_role != 'moderador') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('manterUsuario');
    }
    else
    {
        return view('login');
    }
});


Route::get('AssuntosUsuarios', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev' && $user->user_role != 'admin' && $user->user_role != 'moderador') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('manteruserSubject');
    }
    else
    {
        return view('login');
    }
});


Route::get('Contatos', function(Request $request){
    if($request->session()->exists('user'))
    {
    	$user = $request->session()->get('user');
        if($user->user_role != 'dev' && $user->user_role != 'admin' && $user->user_role != 'moderador') return "<h1 style='color: red;'>Você não tem permissão para acessar essa pagina</h1>";
        else return view('manterContatos');
    }
    else
    {
        return view('login');
    }
});
