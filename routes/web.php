<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\CheckCadastro;

Route::post('/logar', 'UserController@logar')->name('acessar');

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
Route::group(['middleware' => CheckLogin::class], function(){
    Route::get('cadastro', function(Request $request) { return view('cadastroUsuario'); });
    Route::group(['middleware' => CheckCadastro::class], function(){
        Route::get('perfil', function(Request $request){ return view('perfil'); })->name('perfil'); 
        Route::get('cadastroAssunto', function(Request $request){ return view('cadastroAssunto'); });
        Route::get('cadastroContato', function(Request $request){ return view('cadastroContato'); });
        Route::get('alterarPerfil', function(Request $request){ return view('alterarPerfil'); });
        Route::get('alterarSenha', function(Request $request){ return view('alterarSenha'); });
        Route::get('conexoes', function(Request $request){ return view('manterConexoes'); });
        Route::get('solicitacoes', function(Request $request){ return view('manterSolicitacoes'); });
        Route::get('mentores', function(Request $request){ return view('listarMentores'); });
        Route::get('mentorias', function(Request $request){ return view('minhasMentorias'); });
    });

    Route::post('/inserirUsuario', 'UserController@store')->name('inserir');
    Route::post('/inserirUsuario2', 'UserController@store2')->name('inserirUser');
    Route::post('/alterandoUsuario', 'UserController@update')->name('atualizarUsuario');
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
    Route::post('/pegaDadosMentorAdmin', 'KnowledgeController@PegaDadosKnowledgeAdmin')->name('pegaDadosMentorAdmin');
    Route::post('/conectar/{knowledge_id}', 'ConnectionController@salvar')->name('conexao');
    Route::resource('usersubject', 'UserSubjectController');
    Route::resource('subject', 'SubjectController');
    Route::resource('carrer', 'CarrerController');
    Route::resource('profession', 'ProfessionController');
    Route::resource('user', 'UserController');
    Route::resource('contact', 'ContactController');
    Route::resource('knowledge', 'KnowledgeController');
    Route::patch('/ativar/{profession_id}', 'ProfessionController@ativar')->name('ativar');
    Route::patch('/ativarcarrer/{carrer_id}', 'CarrerController@ativarCarreira')->name('ativarcarrer');
    Route::patch('/ativarmentor/{knowledge_id}', 'KnowledgeController@ativarMentor')->name('ativarmentor');
    Route::patch('/ativarsubject/{subject_id}', 'SubjectController@ativarAssunto')->name('ativarsubject');
    Route::post('/alterandoSenha/{user_id}', 'UserController@updateSenha')->name('alterarSenha'); //teste
    Route::delete('user/{user}/subject/{subject}', 'UserSubjectController@deletar')->name('usersubject.deletar'); //teste
    Route::get('/profissao', 'ProfessionController@JsonPopular')->name('jsonpopularProfissao');
    Route::get('/carreira', 'CarrerController@JsonPopular')->name('jsonpopularCarreira');
    Route::get('/assunto', 'SubjectController@JsonPopular')->name('jsonpopularAssunto');
    Route::get('/userassunto', 'UserSubjectController@JsonPopular')->name('jsonpopularUserAssunto');
    Route::patch('/aceitarPedido', 'ConnectionController@aceitar')->name('aceitarPedido');


});

Route::group(['middleware' => CheckAdmin::class], function(){
    Route::get('admin', function(Request $request){ return view('layouts.dashboardAdmin'); });
    Route::get('EditarProfissao', function(Request $request){ return view('edits.profissaoEdit'); });
    Route::get('EditarAssunto', function(Request $request){ return view('edits.assuntosEdit'); });
    Route::get('EditarCarreira', function(Request $request){ return view('edits.carreiraEdit'); });
    Route::get('Profissoes', function(Request $request){ return view('pageTipos'); })->name('Profissoes');
    Route::get('Carreiras', function(Request $request){ return view('manterCarreira'); });
    Route::get('Assuntos', function(Request $request){ return view('manterAssunto'); });
    Route::get('Usuarios', function(Request $request){ return view('manterUsuario'); });
    Route::get('AssuntosUsuarios', function(Request $request){ return view('manteruserSubject'); });
    Route::get('Contatos', function(Request $request){ return view('manterContatos'); });
    Route::get('mentoresAdmin', function(Request $request){ return view('manterMentores'); });
    
});