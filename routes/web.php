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
Route::get('register', ['as' => 'auth.register', 'uses' => 'App\Http\Controllers\Auth\RegisterController@index']);

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);

	

	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);

	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);

	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	Route::get('acessantes', ['as' => 'cadastro.acessante', 'uses' => 'App\Http\Controllers\AcessanteController@index']);

	Route::get('acondicionamento', ['as' => 'administrativo.acondicionamento', 'uses' => 'App\Http\Controllers\AcondicionamentoController@index']);

	Route::get('atividade', ['as' => 'administrativo.atividade', 'uses' => 'App\Http\Controllers\AtividadeController@index']);

	Route::get('tratamento', ['as' => 'administrativo.tratamento', 'uses' => 'App\Http\Controllers\TratamentoController@index']);

	Route::get('unidad', ['as' => 'administrativo.unidad', 'uses' => 'App\Http\Controllers\UnidadController@index']);

	Route::get('marca', ['as' => 'administrativo.marca', 'uses' => 'App\Http\Controllers\MarcaController@index']);

	Route::get('modelo', ['as' => 'administrativo.modelo', 'uses' => 'App\Http\Controllers\ModeloController@index']);

	Route::get('nota_fiscal', ['as' => 'cadastros.notaFiscal', 'uses' => 'App\Http\Controllers\NotaFiscalController@index']);

	Route::get('empresa', ['as' => 'cadastros.empresa', 'uses' => 'App\Http\Controllers\PessoaJuridicaController@index']);

	Route::get('veiculo', ['as' => 'cadastros.veiculo', 'uses' => 'App\Http\Controllers\VeiculoController@index']);
});

