<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::group(['middleware' => ['auth', 'permission']], function () {
	Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

	//MAIL 
	// Route::get('/cadastro/email', function (){
	// 	return new App\Mail\ActivationReceived();
	// });
	Route::get('/cadastro/email', ['as' => 'cadastros.email', 'uses' => 'App\Http\Controllers\EmailController@contact']);


	// Cadastro
	Route::get('/cadastro/empresa', ['as' => 'cadastros.empresa', 'uses' => 'App\Http\Controllers\PessoaJuridicaController@index']);
	Route::get('/cadastro/veiculo', ['as' => 'cadastros.veiculo', 'uses' => 'App\Http\Controllers\VeiculoController@index']);
	Route::get('/cadastro/produto', ['as' => 'cadastros.produto', 'uses' => 'App\Http\Controllers\ProdutoController@index']);
	Route::get('/cadastro/material', ['as' => 'cadastros.material', 'uses' => 'App\Http\Controllers\MateriaisController@index']);
	
	// Administrativo
	Route::get('/administrativo/acondicionamento', ['as' => 'administrativo.acondicionamento', 'uses' => 'App\Http\Controllers\AcondicionamentoController@index']);
	Route::get('/administrativo/tratamento', ['as' => 'administrativo.tratamento', 'uses' => 'App\Http\Controllers\TratamentoController@index']);
	Route::get('/administrativo/classe_sucata', ['as' => 'administrativo.classeSucata', 'uses' => 'App\Http\Controllers\ClasseSucataController@index']);
	Route::get('/administrativo/unidad', ['as' => 'administrativo.unidad', 'uses' => 'App\Http\Controllers\UnidadController@index']);
	Route::get('/administrativo/modelo', ['as' => 'administrativo.modelo', 'uses' => 'App\Http\Controllers\ModeloController@index']);
	Route::get('/administrativo/marca', ['as' => 'administrativo.marca', 'uses' => 'App\Http\Controllers\MarcaController@index']);
	Route::get('/administrativo/estagios_os', ['as' => 'administrativo.estagiosOs', 'uses' => 'App\Http\Controllers\EstagiosOsController@index']);
	Route::get('/administrativo/atividade', ['as' => 'administrativo.atividade', 'uses' => 'App\Http\Controllers\AtividadeController@index']);
	Route::get('/administrativo/tipo_material', ['as' => 'administrativo.tipoMaterial', 'uses' => 'App\Http\Controllers\TipoMaterialController@index']);
	Route::get('/administrativo/tipo_empresa', ['as' => 'administrativo.tipoEmpresa', 'uses' => 'App\Http\Controllers\TipoEmpresaController@index']);
	Route::get('/administrativo/ibama', ['as' => 'administrativo.ibama', 'uses' => 'App\Http\Controllers\IbamaController@index']);
	
	// OS E Rastreamento
	Route::get('/or/rastreamento', ['as' => 'rastreamento.rastreamento', 'uses' => 'App\Http\Controllers\RastreamentoController@index']);
	Route::get('/or/nota_fiscal', ['as' => 'rastreamento.notaFiscal', 'uses' => 'App\Http\Controllers\NotaFiscalController@index']);
	Route::get('/or/ordem_servico', ['as' => 'rastreamento.os', 'uses' => 'App\Http\Controllers\OrdemDeServicoController@index']);

	// Configuracoes
	Route::get('meu_cadastro', ['as' => 'configuracoes.profile', 'uses' => 'App\Http\Controllers\ProfileController@index']);
	Route::get('configuracoes/users', ['as' => 'configuracoes.users', 'uses' => 'App\Http\Controllers\UserController@index']);
	Route::get('configuracoes/roles', ['as' => 'configuracoes.roles', 'uses' => 'App\Http\Controllers\RolesController@index']);
	Route::get('configuracoes/permissions', ['as' => 'configuracoes.permissions', 'uses' => 'App\Http\Controllers\PermissionsController@index']);
});

// Route::get('/cadastro/email', function (){
// 		return new App\Mail\ActivationReceived();
// 	});
