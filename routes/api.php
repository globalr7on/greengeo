<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// API PESSOAS 
Route::get('acessantes', 'App\Http\Controllers\Api\AcessanteController@index');

Route::get('acessantes/{id}', 'App\Http\Controllers\Api\AcessanteController@show');

Route::post('acessantes', 'App\Http\Controllers\Api\AcessanteController@store');

Route::put('acessantes/{id}', 'App\Http\Controllers\Api\AcessanteController@update');

Route::delete('acessantes/{id}', 'App\Http\Controllers\Api\AcessanteController@destroy');

// 


// API ACONDICIONAMENTO 
Route::get('acondicionamento', 'App\Http\Controllers\Api\AcondicionamentoController@index');

Route::get('acondicionamento/{id}', 'App\Http\Controllers\Api\AcondicionamentoController@show');

Route::post('acondicionamento', 'App\Http\Controllers\Api\AcondicionamentoController@store');

Route::put('acondicionamento/{id}', 'App\Http\Controllers\Api\AcondicionamentoController@update');

Route::delete('acondicionamento/{id}', 'App\Http\Controllers\Api\AcondicionamentoController@destroy');

// 


// API Atividade 
Route::get('atividade', 'App\Http\Controllers\Api\AtividadeController@index');

Route::get('atividade/{id}', 'App\Http\Controllers\Api\AtividadeController@show');

Route::post('atividade', 'App\Http\Controllers\Api\AtividadeController@store');

Route::put('atividade/{id}', 'App\Http\Controllers\Api\AtividadeController@update');

Route::delete('atividade/{id}', 'App\Http\Controllers\Api\AtividadeController@destroy');

// 

// API Tratamento 
Route::get('tratamento', 'App\Http\Controllers\Api\TratamentoController@index');

Route::get('tratamento/{id}', 'App\Http\Controllers\Api\TratamentoController@show');

Route::post('tratamento', 'App\Http\Controllers\Api\TratamentoController@store');

Route::put('tratamento/{id}', 'App\Http\Controllers\Api\TratamentoController@update');

Route::delete('tratamento/{id}', 'App\Http\Controllers\Api\TratamentoController@destroy');

// 

// API Unidad 
Route::get('unidad', 'App\Http\Controllers\Api\UnidadController@index');

Route::get('unidad/{id}', 'App\Http\Controllers\Api\UnidadController@show');

Route::post('unidad', 'App\Http\Controllers\Api\UnidadController@store');

Route::put('unidad/{id}', 'App\Http\Controllers\Api\UnidadController@update');

Route::delete('unidad/{id}', 'App\Http\Controllers\Api\UnidadController@destroy');

// 

// API Marca 
Route::get('marca', 'App\Http\Controllers\Api\MarcaController@index');

Route::get('marca/{id}', 'App\Http\Controllers\Api\MarcaController@show');

Route::post('marca', 'App\Http\Controllers\Api\MarcaController@store');

Route::put('marca/{id}', 'App\Http\Controllers\Api\MarcaController@update');

Route::delete('marca/{id}', 'App\Http\Controllers\Api\MarcaController@destroy');

// 

// API Modelo 
Route::get('modelo', 'App\Http\Controllers\Api\ModeloController@index');

Route::get('modelo/{id}', 'App\Http\Controllers\Api\ModeloController@show');

Route::post('modelo', 'App\Http\Controllers\Api\ModeloController@store');

Route::put('modelo/{id}', 'App\Http\Controllers\Api\ModeloController@update');

Route::delete('modelo/{id}', 'App\Http\Controllers\Api\ModeloController@destroy');

// 



// API PESSOAS 
Route::get('pessoa_juridica', 'App\Http\Controllers\Api\PessoaJuridicaController@index');

Route::get('pessoa_juridica/{id}', 'App\Http\Controllers\Api\PessoaJuridicaController@show');

Route::post('pessoa_juridica', 'App\Http\Controllers\Api\PessoaJuridicaController@store');

Route::put('pessoa_juridica/{id}', 'App\Http\Controllers\Api\PessoaJuridicaController@update');

Route::delete('pessoa_juridica/{id}', 'App\Http\Controllers\Api\PessoaJuridicaController@destroy');

// 

// API VEICULOS 
Route::get('veiculo', 'App\Http\Controllers\Api\VeiculoController@index');

Route::get('veiculo/{id}', 'App\Http\Controllers\Api\VeiculoController@show');

Route::post('veiculo', 'App\Http\Controllers\Api\VeiculoController@store');

Route::put('veiculo/{id}', 'App\Http\Controllers\Api\VeiculoController@update');

Route::delete('veiculo/{id}', 'App\Http\Controllers\Api\VeiculoController@destroy');

// 

// API ESTAGIOS OS 
Route::get('estagio_os', 'App\Http\Controllers\Api\EstagiosOsController@index');

Route::get('estagio_os/{id}', 'App\Http\Controllers\Api\EstagiosOsController@show');

Route::post('estagio_os', 'App\Http\Controllers\Api\EstagiosOsController@store');

Route::put('estagio_os/{id}', 'App\Http\Controllers\Api\EstagiosOsController@update');

Route::delete('estagio_os/{id}', 'App\Http\Controllers\Api\EstagiosOsController@destroy');

// 