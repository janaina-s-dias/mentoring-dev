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

Route::post('/inserirUsuario', 'UserController@store')->name('inserir');
Route::post('/alterandoUsuario', 'UserController@update')->name('atualizarUsuario');
Route::post('/logar', 'UserController@logar')->name('acessar');
Route::get('/sair', 'UserController@logout')->name('sair');
Route::post('/pegaDados', 'ProfessionController@PegaDados')->name('pegaDados');
Route::post('/pegaDadosCarreira', 'CarrerController@PegaDadosCarreira')->name('pegaDadosCarreira');
Route::post('/pegaDadosAssunto', 'SubjectController@PegaDadosAssunto')->name('pegaDadosAssunto');
Route::resource('usersubject', 'UserSubjectController');
Route::get('/pegaProfissao', 'ProfessionController@index')->name('usProfissao');
Route::get('/pegaCarreira', 'CarrerController@index')->name('usCarreira');
Route::get('/pegaAssunto', 'SubjectController@index')->name('usAssunto');



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
});


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





