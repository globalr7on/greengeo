<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// USERS 
Route::get('users', 'App\Http\Controllers\Api\UserController@index');
Route::get('users/{id}', 'App\Http\Controllers\Api\UserController@show');
Route::post('users', 'App\Http\Controllers\Api\UserController@store');
Route::put('users/{id}', 'App\Http\Controllers\Api\UserController@update');
Route::delete('users/{id}', 'App\Http\Controllers\Api\UserController@destroy');

// ROLES
Route::get('roles', 'App\Http\Controllers\Api\RoleController@index');
Route::get('roles/{id}', 'App\Http\Controllers\Api\RoleController@show');
Route::post('roles', 'App\Http\Controllers\Api\RoleController@store');
Route::put('roles/{id}', 'App\Http\Controllers\Api\RoleController@update');
Route::delete('roles/{id}', 'App\Http\Controllers\Api\RoleController@destroy');

// PERMISSIONS
Route::get('permissions', 'App\Http\Controllers\Api\PermissionController@index');
Route::get('permissions/{id}', 'App\Http\Controllers\Api\PermissionController@show');
Route::post('permissions', 'App\Http\Controllers\Api\PermissionController@store');
Route::put('permissions/{id}', 'App\Http\Controllers\Api\PermissionController@update');
Route::delete('permissions/{id}', 'App\Http\Controllers\Api\PermissionController@destroy');

// ACONDICIONAMENTO 
Route::get('acondicionamento', 'App\Http\Controllers\Api\AcondicionamentoController@index');
Route::get('acondicionamento/{id}', 'App\Http\Controllers\Api\AcondicionamentoController@show');
Route::post('acondicionamento', 'App\Http\Controllers\Api\AcondicionamentoController@store');
Route::put('acondicionamento/{id}', 'App\Http\Controllers\Api\AcondicionamentoController@update');
Route::delete('acondicionamento/{id}', 'App\Http\Controllers\Api\AcondicionamentoController@destroy');

// ATIVIDADE 
Route::get('atividade', 'App\Http\Controllers\Api\AtividadeController@index');
Route::get('atividade/{id}', 'App\Http\Controllers\Api\AtividadeController@show');
Route::post('atividade', 'App\Http\Controllers\Api\AtividadeController@store');
Route::put('atividade/{id}', 'App\Http\Controllers\Api\AtividadeController@update');
Route::delete('atividade/{id}', 'App\Http\Controllers\Api\AtividadeController@destroy');

// TRATAMENTO 
Route::get('tratamento', 'App\Http\Controllers\Api\TratamentoController@index');
Route::get('tratamento/{id}', 'App\Http\Controllers\Api\TratamentoController@show');
Route::post('tratamento', 'App\Http\Controllers\Api\TratamentoController@store');
Route::put('tratamento/{id}', 'App\Http\Controllers\Api\TratamentoController@update');
Route::delete('tratamento/{id}', 'App\Http\Controllers\Api\TratamentoController@destroy');

// UNIDAD 
Route::get('unidad', 'App\Http\Controllers\Api\UnidadController@index');
Route::get('unidad/{id}', 'App\Http\Controllers\Api\UnidadController@show');
Route::post('unidad', 'App\Http\Controllers\Api\UnidadController@store');
Route::put('unidad/{id}', 'App\Http\Controllers\Api\UnidadController@update');
Route::delete('unidad/{id}', 'App\Http\Controllers\Api\UnidadController@destroy');

// MARCA 
Route::get('marca', 'App\Http\Controllers\Api\MarcaController@index');
Route::get('marca/{id}', 'App\Http\Controllers\Api\MarcaController@show');
Route::post('marca', 'App\Http\Controllers\Api\MarcaController@store');
Route::put('marca/{id}', 'App\Http\Controllers\Api\MarcaController@update');
Route::delete('marca/{id}', 'App\Http\Controllers\Api\MarcaController@destroy');

// MODELO 
Route::get('modelo', 'App\Http\Controllers\Api\ModeloController@index');
Route::get('modelo/{id}', 'App\Http\Controllers\Api\ModeloController@show');
Route::post('modelo', 'App\Http\Controllers\Api\ModeloController@store');
Route::put('modelo/{id}', 'App\Http\Controllers\Api\ModeloController@update');
Route::delete('modelo/{id}', 'App\Http\Controllers\Api\ModeloController@destroy');

// PESSOAS 
Route::get('pessoa_juridica', 'App\Http\Controllers\Api\PessoaJuridicaController@index');
Route::get('pessoa_juridica/{id}', 'App\Http\Controllers\Api\PessoaJuridicaController@show');
Route::post('pessoa_juridica', 'App\Http\Controllers\Api\PessoaJuridicaController@store');
Route::put('pessoa_juridica/{id}', 'App\Http\Controllers\Api\PessoaJuridicaController@update');
Route::delete('pessoa_juridica/{id}', 'App\Http\Controllers\Api\PessoaJuridicaController@destroy');

// VEICULOS 
Route::get('veiculo', 'App\Http\Controllers\Api\VeiculoController@index');
Route::get('veiculo/{id}', 'App\Http\Controllers\Api\VeiculoController@show');
Route::post('veiculo', 'App\Http\Controllers\Api\VeiculoController@store');
Route::put('veiculo/{id}', 'App\Http\Controllers\Api\VeiculoController@update');
Route::delete('veiculo/{id}', 'App\Http\Controllers\Api\VeiculoController@destroy');

// ESTAGIOS OS 
Route::get('estagio_os', 'App\Http\Controllers\Api\EstagiosOsController@index');
Route::get('estagio_os/{id}', 'App\Http\Controllers\Api\EstagiosOsController@show');
Route::post('estagio_os', 'App\Http\Controllers\Api\EstagiosOsController@store');
Route::put('estagio_os/{id}', 'App\Http\Controllers\Api\EstagiosOsController@update');
Route::delete('estagio_os/{id}', 'App\Http\Controllers\Api\EstagiosOsController@destroy');

// TIPO CLASSES DE SUCATAS
Route::get('classe_sucata', 'App\Http\Controllers\Api\ClasseSucataController@index');
Route::get('classe_sucata/{id}', 'App\Http\Controllers\Api\ClasseSucataController@show');
Route::post('classe_sucata', 'App\Http\Controllers\Api\ClasseSucataController@store');
Route::put('classe_sucata/{id}', 'App\Http\Controllers\Api\ClasseSucataController@update');
Route::delete('classe_sucata/{id}', 'App\Http\Controllers\Api\ClasseSucataController@destroy');


// TIPO classe de materiais
Route::get('tipo_materiais', 'App\Http\Controllers\Api\TipoMaterialController@index');
Route::get('tipo_materiais/{id}', 'App\Http\Controllers\Api\TipoMaterialController@show');
Route::post('tipo_materiais', 'App\Http\Controllers\Api\TipoMaterialController@store');
Route::put('tipo_materiais/{id}', 'App\Http\Controllers\Api\TipoMaterialController@update');
Route::delete('tipo_materiais/{id}', 'App\Http\Controllers\Api\TipoMaterialController@destroy');
