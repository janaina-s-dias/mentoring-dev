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
        return view('home');
    }
    else
    {
        return view('login');
    }
        
});

Route::get('perfil', function(Request $request){
    if($request->session()->exists('user'))
    {
        return view('perfil');
    }
    else
    {
        return view('login');
    }
        
})->name('perfil');

Route::get('cadastroAssunto', function(Request $request){
    if($request->session()->exists('user'))
    {
        return view('cadastroAssunto');
    }
    else
    {
        return view('login');
    }
        
});

Route::get('alterarPerfil', function(Request $request){
    if($request->session()->exists('user'))
    {
        return view('alterarPerfil');
    }
    else
    {
        return view('login');
    }
        
});

Route::get('alterarSenha', function(Request $request){
    if($request->session()->exists('user'))
    {
        return view('alterarSenha');
    }
    else
    {
        return view('login');
    }
        
});

Route::post('/inserirUsuario', 'UserController@store')->name('inserir');
Route::any('/inserirUsuario2', 'UserController@store2')->name('inserirUser');
Route::post('/alterandoUsuario', 'UserController@update')->name('atualizarUsuario');
Route::post('/logar', 'UserController@logar')->name('acessar');
Route::get('/sair', 'UserController@logout')->name('sair');
Route::post('/pegaDados', 'ProfessionController@PegaDados')->name('pegaDados');
Route::post('/pegaDadosCarreira', 'CarrerController@PegaDadosCarreira')->name('pegaDadosCarreira');
Route::post('/pegaDadosAssunto', 'SubjectController@PegaDadosAssunto')->name('pegaDadosAssunto');
Route::post('/pegaDadosUsuario', 'SubjectController@PegaDadosUsuario')->name('pegaDadosUsuario');
Route::resource('usersubject', 'UserSubjectController');
Route::resource('subject', 'SubjectController');
Route::resource('carrer', 'CarrerController');
Route::resource('profession', 'ProfessionController');

Route::get('/profissao', function(){
    $profession = \App\Profession::all();
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
    $carrer = \App\Carrer::where('fk_carrer_profession', '=', $profession)->get();
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
    $subject = \App\Subject::where('fk_subject_carrer', $carrer)->get();
    $dados = array();
    foreach ($subject as $value) {
        $subarray = array();
        $subarray['subject_id'] = $value->subject_id;
        $subarray['subject_nome'] = $value->subject_name;
        $dados[]=$subarray;
    }
    return Response::json($dados);
    
});

Route::get('tables', function(Request $request){
    if($request->session()->exists('user'))
    {
    	return view('table');
    }
    else
    {
        return view('login');
    }
});

Route::get('forms', function(Request $request){
    if($request->session()->exists('user'))
    {
    	return view('form');
    }
    else
    {
        return view('login');
    }
});


Route::get('charts', function(Request $request){
    if($request->session()->exists('user'))
    {
    	return view('mcharts');
    }
    else
    {
        return view('login');
    }
});

Route::get('blank', function(Request $request){
    if($request->session()->exists('user'))
    {
    	return view('blank');
    }
    else
    {
        return view('login');
    }
});

Route::get('panel', function(Request $request){
    
    if($request->session()->exists('user'))
    {
    	return view('panel');
    }
    else
    {
        return view('login');
    }

});

Route::get('collapse', function(Request $request){
    if($request->session()->exists('user'))
    {
    	return view('collapse');
    }
    else
    {
        return view('login');
    }
});

Route::get('documentation', function(Request $request){
    if($request->session()->exists('user'))
    {
    	return view('documentation');
    }
    else
    {
        return view('login');
    }
});

Route::get('icons', function(Request $request){
    if($request->session()->exists('user'))
    {
    	return view('icons');
    }
    else
    {
        return view('login');
    }
});

Route::get('notifications', function(Request $request){
    if($request->session()->exists('user'))
    {
    	return view('notifications');
    }
    else
    {
        return view('login');
    }
});

Route::get('panels', function(Request $request){
    if($request->session()->exists('user'))
    {
    	return view('panel');
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
    	return view('stats');
    }
    else
    {
        return view('login');
    }
});

Route::get('typography', function(Request $request){
    if($request->session()->exists('user'))
    {
    	return view('typography');
    }
    else
    {
        return view('login');
    }
});

Route::get('buttons', function(Request $request){
  if($request->session()->exists('user'))
    {
    	return view('buttons');
    }
    else
    {
        return view('login');
    }
});

Route::get('grid', function(Request $request){
    if($request->session()->exists('user'))
    {
    	return view('grid');
    }
    else
    {
        return view('login');
    }
});


Route::get('admin', function(Request $request){
    if($request->session()->exists('user'))
    {
    	return view('layouts.dashboardAdmin');
    }
    else
    {
        return view('login');
    }
});

Route::get('Profissoes', function(Request $request){
    if($request->session()->exists('user'))
    {
    	return view('pageTipos');
    }
    else
    {
        return view('login');
    }
})->name('Profissoes');


Route::get('Carreiras', function(Request $request){
    if($request->session()->exists('user'))
    {
    	return view('manterCarreira');
    }
    else
    {
        return view('login');
    }
});


Route::get('Assuntos', function(Request $request){
    if($request->session()->exists('user'))
    {
    	return view('manterAssunto');
    }
    else
    {
        return view('login');
    }
});





