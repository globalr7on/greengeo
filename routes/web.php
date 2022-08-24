<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::get('xml','App\Http\Controllers\ReadXmlController@index')->name('xml');

	// Route::get('/cadastro/empresa', 'App\Http\Controllers\PessoaJuridicaController@index')



Auth::routes(['verify' => true]);


// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');


// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     dd("Pasando por aqui mi pana ");
// 	$request->fulfill();
 
//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');


// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
 
//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => ['auth', 'permission']], function () {
	Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');
	Route::get('/cadastro/email', 'App\Http\Controllers\EmailController@contact')->name('cadastros.email');

	// Cadastro
	Route::get('/cadastro/empresa', 'App\Http\Controllers\PessoaJuridicaController@index')->name('cadastros.empresa');
	Route::get('/cadastro/veiculo', 'App\Http\Controllers\VeiculoController@index')->name('cadastros.veiculo');
	Route::get('/cadastro/produto', 'App\Http\Controllers\ProdutoController@index')->name('cadastros.produto');
	Route::get('/cadastro/material', 'App\Http\Controllers\MateriaisController@index')->name('cadastros.material');
	
	// Administrativo
	Route::get('/administrativo/acondicionamento', 'App\Http\Controllers\AcondicionamentoController@index')->name('administrativo.acondicionamento');
	Route::get('/administrativo/tratamento', 'App\Http\Controllers\TratamentoController@index')->name('administrativo.tratamento');
	Route::get('/administrativo/classe_sucata', 'App\Http\Controllers\ClasseSucataController@index')->name('administrativo.classeSucata');
	Route::get('/administrativo/unidad', 'App\Http\Controllers\UnidadController@index')->name('administrativo.unidad');
	Route::get('/administrativo/modelo', 'App\Http\Controllers\ModeloController@index')->name('administrativo.modelo');
	Route::get('/administrativo/marca', 'App\Http\Controllers\MarcaController@index')->name('administrativo.marca');
	Route::get('/administrativo/estagios_os', 'App\Http\Controllers\EstagiosOsController@index')->name('administrativo.estagiosOs');
	Route::get('/administrativo/atividade', 'App\Http\Controllers\AtividadeController@index')->name('administrativo.atividade');
	Route::get('/administrativo/tipo_material', 'App\Http\Controllers\TipoMaterialController@index')->name('administrativo.tipoMaterial');
	Route::get('/administrativo/tipo_empresa','App\Http\Controllers\TipoEmpresaController@index')->name('administrativo.tipoEmpresa');
	Route::get('/administrativo/ibama', 'App\Http\Controllers\IbamaController@index')->name('administrativo.ibama');
	
	// OS E Rastreamento
	Route::get('/or/rastreamento', 'App\Http\Controllers\RastreamentoController@index')->name('rastreamento.rastreamento');
	Route::get('/or/nota_fiscal', 'App\Http\Controllers\NotaFiscalController@index')->name('rastreamento.notaFiscal');
	Route::get('/or/ordem_servico', 'App\Http\Controllers\OrdemDeServicoController@index')->name('rastreamento.os');
	Route::get('/or/fotos', 'App\Http\Controllers\ImagensController@index')->name('imagens');

	// Configuracoes
	Route::get('meu_cadastro', 'App\Http\Controllers\ProfileController@index')->name('configuracoes.perfil');
	Route::get('configuracoes/users', 'App\Http\Controllers\UserController@index')->name('configuracoes.usuarios');
	Route::get('configuracoes/roles', 'App\Http\Controllers\RolesController@index')->name('configuracoes.funcoes');
	Route::get('configuracoes/permissions', 'App\Http\Controllers\PermissionsController@index')->name('configuracoes.permissoes');
});
