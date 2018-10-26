<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\CheckCadastro;

Route::post('/logar', 'UserController@logar')->name('acessar');
Route::post('/inserirUsuario', 'UserController@store')->name('inserir');
Route::get('/', function(){
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
    Route::get('cadastro', function() { return view('cadastroUsuario'); });
    Route::group(['middleware' => CheckCadastro::class], function(){
        Route::get('perfil', function(){ return view('perfil'); })->name('perfil'); 
        Route::get('cadastroAssunto', function(){ return view('cadastroAssunto'); });
        Route::get('cadastroContato', function(){ return view('cadastroContato'); });
        Route::get('meusContatos', function(){ return view('meusContatos'); });
        Route::get('alterarPerfil', function(){ return view('alterarPerfil'); });
        Route::get('alterarSenha', function(){ return view('alterarSenha'); });
        Route::get('conexoes', function(){ return view('manterConexoes'); });
        Route::get('solicitacoes', function(){ return view('manterSolicitacoes'); });
        Route::get('mentores', function(){ return view('listarMentores'); });
        Route::get('mentorias', function(){ return view('minhasMentorias'); });
        Route::get('conteudo', function(){ return view('cadastroConteudo'); });
        Route::get('Mentoria_no_assunto', function(){ return view('edits.userSubjectEdit'); });
        Route::get('editarMentoria/{id}', 'KnowledgeController@criarMentorSobreAssunto')->name('editarMeuAssuntoSemMentoria');
        Route::get('editarConteudo', function(){ return view('edits.conteudoEdit'); });
    });

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
    Route::resource('content', 'ContentController');
    Route::patch('/ativar/{profession_id}', 'ProfessionController@ativar')->name('ativar');
    Route::patch('/ativarcarrer/{carrer_id}', 'CarrerController@ativarCarreira')->name('ativarcarrer');
    Route::patch('/ativarmentor/{knowledge_id}', 'KnowledgeController@ativarMentor')->name('ativarmentor');
    Route::patch('/ativarsubject/{subject_id}', 'SubjectController@ativarAssunto')->name('ativarsubject');
    Route::post('/alterandoSenha/{user_id}', 'UserController@updateSenha')->name('alterarSenha'); //teste
    Route::post('/alterandoMentor', 'KnowledgeController@alteraMentor')->name('alteraMentor');
    Route::delete('user/{user}/subject/{subject}', 'UserSubjectController@deletar')->name('usersubject.deletar'); //teste
    Route::get('/profissao', 'ProfessionController@JsonPopular')->name('jsonpopularProfissao');
    Route::get('/carreira', 'CarrerController@JsonPopular')->name('jsonpopularCarreira');
    Route::get('/assunto', 'SubjectController@JsonPopular')->name('jsonpopularAssunto');
    Route::get('/userassunto', 'UserSubjectController@JsonPopular')->name('jsonpopularUserAssunto');
    Route::patch('/aceitarPedido/{user}', 'ConnectionController@aceitarSolicitacao')->name('aceitarPedido');
    Route::patch('/cancelarSolicitacao/{connection}', 'ConnectionController@excluirSolicitacao')->name('cancelarSolicitacao');
    Route::get('/mentorOuNao', 'UserSubjectController@editUserSubjectMentoria')->name('mentorOuNao');
    //Route::delete('/recusarPedido/{connection}', 'ConnectionController@excluirSolicitacao')->name('recusarPedido');
    Route::post('/pegaDadosConteudo', 'ContentController@PegaDadosConteudo')->name('pegaDadosConteudo');


});


Route::group(['middleware' => CheckAdmin::class], function(){
    Route::get('admin', function(){ return view('layouts.dashboardAdmin'); });
    Route::get('EditarProfissao', function(){ return view('edits.profissaoEdit'); });
    Route::get('EditarAssunto', function(){ return view('edits.assuntosEdit'); });
    Route::get('EditarCarreira', function(){ return view('edits.carreiraEdit'); });
    Route::get('Profissoes', function(){ return view('pageTipos'); })->name('Profissoes');
    Route::get('Carreiras', function(){ return view('manterCarreira'); });
    Route::get('Assuntos', function(){ return view('manterAssunto'); });
    Route::get('Usuarios', function(){ return view('manterUsuario'); });
    Route::get('AssuntosUsuarios', function(){ return view('manteruserSubject'); });
    Route::get('Contatos', function(){ return view('manterContatos'); });
    Route::get('mentoresAdmin', function(){ return view('manterMentores'); });
    Route::get('conteudos', function(){ return view('manterConteudo'); })->name('conteudos');
    // Route::get('EditarConteudo', function(){ return view('edits.conteudoEdit'); });
    
});
