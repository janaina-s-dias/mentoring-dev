<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckAdmin;

Route::get('cadastro', function(Request $request) {
    if(Auth::check())
    {
        return view('cadastroUsuario');
    }
    else
    {
        return view('login');
    }
});
Route::get('/', function(Request $request){
    if(Auth::check())
    {
        $user = Auth::user();
        if($user->user_nome == null || $user->user_cpf == null || $user->user_rg == null) return view('cadastroUsuario');
        else return view('home');
    }
    else
    {
        return view('login');
    }
        
});
Route::get('perfil', function(Request $request){
    if(Auth::check())
    {
        $user = Auth::user();
        if($user->user_nome == null || $user->user_cpf == null || $user->user_rg == null) return view('cadastroUsuario');
        else return view('perfil');
    }
    else
    {
        return view('login');
    }
        
})->name('perfil');
Route::get('cadastroAssunto', function(Request $request){
    if(Auth::check())
    {
        $user = Auth::user();
        if($user->user_nome == null || $user->user_cpf == null || $user->user_rg == null) return view('cadastroUsuario');
        else return view('cadastroAssunto');
    }
    else
    {
        return view('login');
    }
        
});
Route::get('alterarPerfil', function(Request $request){
    if(Auth::check())
    {
        $user = Auth::user();
        if($user->user_nome == null || $user->user_cpf == null || $user->user_rg == null) return view('cadastroUsuario');
        else return view('alterarPerfil');
    }
    else
    {
        return view('login');
    }
        
});
Route::get('alterarSenha', function(Request $request){
    if(Auth::check())
    {
        $user = Auth::user();
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
Route::post('/pegaDadosConexao', 'ConnectionController@PegaDadosConexao')->name('pegaDadosConexao');
Route::post('/pegaDadosSolicitacao', 'ConnectionController@PegaDadosSolicitacao')->name('pegaDadosSolicitacao');
Route::post('/pegaDadosMentor', 'KnowledgeController@PegaDadosKnowledge')->name('pegaDadosMentor');
Route::post('/conectar/{mentor}', 'ConnectionController@salvar')->name('conexao');
Route::resource('usersubject', 'UserSubjectController');
Route::resource('subject', 'SubjectController');
Route::resource('carrer', 'CarrerController');
Route::resource('profession', 'ProfessionController');
Route::resource('user', 'UserController');
Route::resource('contact', 'ContactController');
Route::resource('knowledge', 'KnowledgeController');
Route::patch('/ativar/{profession_id}', 'ProfessionController@ativar')->name('ativar');
Route::patch('/ativarcarrer/{carrer_id}', 'CarrerController@ativarCarreira')->name('ativarcarrer');
Route::patch('/ativarsubject/{subject_id}', 'SubjectController@ativarAssunto')->name('ativarsubject');
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
Route::group(['middleware' => CheckAdmin::class], function(){
Route::get('admin', function(Request $request){
    return view('layouts.dashboardAdmin');
});
Route::get('EditarProfissao', function(Request $request){
    return view('edits.profissaoEdit');
});
Route::get('EditarAssunto', function(Request $request){
    return view('edits.assuntosEdit');
});
Route::get('EditarCarreira', function(Request $request){
    return view('edits.carreiraEdit');
});
Route::get('Profissoes', function(Request $request){
    return view('pageTipos');
})->name('Profissoes');
Route::get('Carreiras', function(Request $request){
    return view('manterCarreira');
});
Route::get('Assuntos', function(Request $request){
    return view('manterAssunto');
});
Route::get('Usuarios', function(Request $request){
    return view('manterUsuario');
});
Route::get('AssuntosUsuarios', function(Request $request){
    return view('manteruserSubject');
});
Route::get('Contatos', function(Request $request){
    return view('manterContatos');
});
});
Route::get('conexoes', function(Request $request){
    if(Auth::check())
    {
    	$user = Auth::user();
        if($user->user_nome == null || $user->user_cpf == null || $user->user_rg == null) return view('cadastroUsuario');
        else return view('manterConexoes');
    }
    else
    {
        return view('login');
    }
});
Route::get('solicitacoes', function(Request $request){
    if(Auth::check())
    {
        $user = Auth::user();
        if($user->user_nome == null || $user->user_cpf == null || $user->user_rg == null) return view('cadastroUsuario');
        else return view('manterSolicitacoes');
    }
    else
    {
        return view('login');
    }
});
Route::get('mentores', function(Request $request){
    if(Auth::check())
    {
        $user = Auth::user();
        if($user->user_nome == null || $user->user_cpf == null || $user->user_rg == null) return view('cadastroUsuario');
        else return view('listarMentores');
    }
    else
    {
        return view('login');
    }
});
Route::get('mentorias', function(Request $request){
    if(Auth::check())
    {
        $user = Auth::user();
        if($user->user_nome == null || $user->user_cpf == null || $user->user_rg == null) return view('cadastroUsuario');
        else return view('minhasMentorias');
    }
    else
    {
        return view('login');
    }
});