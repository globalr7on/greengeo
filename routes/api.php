<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;

Route::post('login','App\Http\Controllers\Api\UserController@accessToken');

Route::middleware(['auth:api', 'permission'])->group(function(){
    // AUTHENTICATED USER
    Route::get('me', function (Request $request) { return new UserResource($request->user()); })->name('me');
    // Route::get('logout', 'App\Http\Controllers\Api\UserController@logout')->name('logout');

    // USERS
    Route::get('users', 'App\Http\Controllers\Api\UserController@index')->name('users.index');
    Route::get('users/{id}', 'App\Http\Controllers\Api\UserController@show')->name('users.show');
    Route::post('users', 'App\Http\Controllers\Api\UserController@store')->name('users.store');
    Route::put('users/{id}', 'App\Http\Controllers\Api\UserController@update')->name('users.update');
    Route::delete('users/{id}', 'App\Http\Controllers\Api\UserController@destroy')->name('users.destroy');

    // ROLES
    Route::get('roles', 'App\Http\Controllers\Api\RoleController@index')->name('roles.index');
    Route::get('roles/{id}', 'App\Http\Controllers\Api\RoleController@show')->name('roles.show');
    Route::post('roles', 'App\Http\Controllers\Api\RoleController@store')->name('roles.store');
    Route::put('roles/{id}', 'App\Http\Controllers\Api\RoleController@update')->name('roles.update');
    Route::delete('roles/{id}', 'App\Http\Controllers\Api\RoleController@destroy')->name('roles.destroy');

    // PERMISSIONS
    Route::get('permissions', 'App\Http\Controllers\Api\PermissionController@index')->name('permissions.index');
    Route::get('permissions/{id}', 'App\Http\Controllers\Api\PermissionController@show')->name('permissions.show');
    Route::post('permissions', 'App\Http\Controllers\Api\PermissionController@store')->name('permissions.store');
    Route::put('permissions/{id}', 'App\Http\Controllers\Api\PermissionController@update')->name('permissions.update');
    Route::delete('permissions/{id}', 'App\Http\Controllers\Api\PermissionController@destroy')->name('permissions.destroy');

    // ACONDICIONAMENTO
    Route::get('acondicionamento', 'App\Http\Controllers\Api\AcondicionamentoController@index')->name('acondicionamento.index');
    Route::get('acondicionamento/{id}', 'App\Http\Controllers\Api\AcondicionamentoController@show')->name('acondicionamento.show');
    Route::post('acondicionamento', 'App\Http\Controllers\Api\AcondicionamentoController@store')->name('acondicionamento.store');
    Route::put('acondicionamento/{id}', 'App\Http\Controllers\Api\AcondicionamentoController@update')->name('acondicionamento.update');
    Route::delete('acondicionamento/{id}', 'App\Http\Controllers\Api\AcondicionamentoController@destroy')->name('acondicionamento.destroy');

    // ATIVIDADE
    Route::get('atividade', 'App\Http\Controllers\Api\AtividadeController@index')->name('atividade.index');
    Route::get('atividade/{id}', 'App\Http\Controllers\Api\AtividadeController@show')->name('atividade.show');
    Route::post('atividade', 'App\Http\Controllers\Api\AtividadeController@store')->name('atividade.store');
    Route::put('atividade/{id}', 'App\Http\Controllers\Api\AtividadeController@update')->name('atividade.update');
    Route::delete('atividade/{id}', 'App\Http\Controllers\Api\AtividadeController@destroy')->name('atividade.destroy');

    // TRATAMENTO
    Route::get('tratamento', 'App\Http\Controllers\Api\TratamentoController@index')->name('tratamento.index');
    Route::get('tratamento/{id}', 'App\Http\Controllers\Api\TratamentoController@show')->name('tratamento.show');
    Route::post('tratamento', 'App\Http\Controllers\Api\TratamentoController@store')->name('tratamento.store');
    Route::put('tratamento/{id}', 'App\Http\Controllers\Api\TratamentoController@update')->name('tratamento.update');
    Route::delete('tratamento/{id}', 'App\Http\Controllers\Api\TratamentoController@destroy')->name('tratamento.destroy');

    // UNIDAD
    Route::get('unidad', 'App\Http\Controllers\Api\UnidadController@index')->name('unidad.index');
    Route::get('unidad/{id}', 'App\Http\Controllers\Api\UnidadController@show')->name('unidad.show');
    Route::post('unidad', 'App\Http\Controllers\Api\UnidadController@store')->name('unidad.store');
    Route::put('unidad/{id}', 'App\Http\Controllers\Api\UnidadController@update')->name('unidad.update');
    Route::delete('unidad/{id}', 'App\Http\Controllers\Api\UnidadController@destroy')->name('unidad.destroy');

    // MARCA
    Route::get('marca', 'App\Http\Controllers\Api\MarcaController@index')->name('marca.index');
    Route::get('marca/{id}', 'App\Http\Controllers\Api\MarcaController@show')->name('marca.show');
    Route::post('marca', 'App\Http\Controllers\Api\MarcaController@store')->name('marca.store');
    Route::put('marca/{id}', 'App\Http\Controllers\Api\MarcaController@update')->name('marca.update');
    Route::delete('marca/{id}', 'App\Http\Controllers\Api\MarcaController@destroy')->name('marca.destroy');

    // MODELO
    Route::get('modelo', 'App\Http\Controllers\Api\ModeloController@index')->name('modelo.index');
    Route::get('modelo/{id}', 'App\Http\Controllers\Api\ModeloController@show')->name('modelo.show');
    Route::post('modelo', 'App\Http\Controllers\Api\ModeloController@store')->name('modelo.store');
    Route::put('modelo/{id}', 'App\Http\Controllers\Api\ModeloController@update')->name('modelo.update');
    Route::delete('modelo/{id}', 'App\Http\Controllers\Api\ModeloController@destroy')->name('modelo.destroy');

    // PESSOAS
    Route::get('pessoa_juridica', 'App\Http\Controllers\Api\PessoaJuridicaController@index')->name('pessoa_juridica.index');
    Route::get('pessoa_juridica/{id}', 'App\Http\Controllers\Api\PessoaJuridicaController@show')->name('pessoa_juridica.show');
    Route::post('pessoa_juridica', 'App\Http\Controllers\Api\PessoaJuridicaController@store')->name('pessoa_juridica.store');
    Route::put('pessoa_juridica/{id}', 'App\Http\Controllers\Api\PessoaJuridicaController@update')->name('pessoa_juridica.update');
    Route::delete('pessoa_juridica/{id}', 'App\Http\Controllers\Api\PessoaJuridicaController@destroy')->name('pessoa_juridica.destroy');

    // VEICULOS
    Route::get('veiculo', 'App\Http\Controllers\Api\VeiculoController@index')->name('veiculo.index');
    Route::get('veiculo/{id}', 'App\Http\Controllers\Api\VeiculoController@show')->name('veiculo.show');
    Route::post('veiculo', 'App\Http\Controllers\Api\VeiculoController@store')->name('veiculo.store');
    Route::put('veiculo/{id}', 'App\Http\Controllers\Api\VeiculoController@update')->name('veiculo.update');
    Route::delete('veiculo/{id}', 'App\Http\Controllers\Api\VeiculoController@destroy')->name('veiculo.destroy');

    // ESTAGIOS OS
    Route::get('estagio_os', 'App\Http\Controllers\Api\EstagiosOsController@index')->name('estagio_os.index');
    Route::get('estagio_os/{id}', 'App\Http\Controllers\Api\EstagiosOsController@show')->name('estagio_os.show');
    Route::post('estagio_os', 'App\Http\Controllers\Api\EstagiosOsController@store')->name('estagio_os.store');
    Route::put('estagio_os/{id}', 'App\Http\Controllers\Api\EstagiosOsController@update')->name('estagio_os.update');
    Route::delete('estagio_os/{id}', 'App\Http\Controllers\Api\EstagiosOsController@destroy')->name('estagio_os.destroy');

    // TIPO CLASSES DE SUCATAS
    Route::get('classe_sucata', 'App\Http\Controllers\Api\ClasseSucataController@index')->name('classe_sucata.index');
    Route::get('classe_sucata/{id}', 'App\Http\Controllers\Api\ClasseSucataController@show')->name('classe_sucata.show');
    Route::post('classe_sucata', 'App\Http\Controllers\Api\ClasseSucataController@store')->name('classe_sucata.store');
    Route::put('classe_sucata/{id}', 'App\Http\Controllers\Api\ClasseSucataController@update')->name('classe_sucata.update');
    Route::delete('classe_sucata/{id}', 'App\Http\Controllers\Api\ClasseSucataController@destroy')->name('classe_sucata.destroy');

    // TIPO CLASSE DE MATERIAIS
    Route::get('tipo_materiais', 'App\Http\Controllers\Api\TipoMaterialController@index')->name('tipo_materiais.index');
    Route::get('tipo_materiais/{id}', 'App\Http\Controllers\Api\TipoMaterialController@show')->name('tipo_materiais.show');
    Route::post('tipo_materiais', 'App\Http\Controllers\Api\TipoMaterialController@store')->name('tipo_materiais.store');
    Route::put('tipo_materiais/{id}', 'App\Http\Controllers\Api\TipoMaterialController@update')->name('tipo_materiais.update');
    Route::delete('tipo_materiais/{id}', 'App\Http\Controllers\Api\TipoMaterialController@destroy')->name('tipo_materiais.destroy');

    // OS 
    Route::get('os', 'App\Http\Controllers\Api\OrdenDeServicoController@index')->name('os.index');
    Route::get('os/{id}', 'App\Http\Controllers\Api\OrdenDeServicoController@show')->name('os.show');
    Route::post('os', 'App\Http\Controllers\Api\OrdenDeServicoController@store')->name('os.store');
    Route::put('os/{id}', 'App\Http\Controllers\Api\OrdenDeServicoController@update')->name('os.update');
    Route::delete('os/{id}', 'App\Http\Controllers\Api\OrdenDeServicoController@destroy')->name('os.destroy');

    // TIPO EMPRESA
    Route::get('tipo_empresa', 'App\Http\Controllers\Api\TipoEmpresaController@index')->name('tipo_empresa.index');
    Route::get('tipo_empresa/{id}', 'App\Http\Controllers\Api\TipoEmpresaController@show')->name('tipo_empresa.show');
    Route::post('tipo_empresa', 'App\Http\Controllers\Api\TipoEmpresaController@store')->name('tipo_empresa.store');
    Route::put('tipo_empresa/{id}', 'App\Http\Controllers\Api\TipoEmpresaController@update')->name('tipo_empresa.update');
    Route::delete('tipo_empresa/{id}', 'App\Http\Controllers\Api\TipoEmpresaController@destroy')->name('tipo_empresa.destroy');
    
    
    // PRODUTO
    Route::get('produto', 'App\Http\Controllers\Api\ProdutoController@index')->name('produto.index');
    Route::get('produto/{id}', 'App\Http\Controllers\Api\ProdutoController@show')->name('produto.show');
    Route::post('produto', 'App\Http\Controllers\Api\ProdutoController@store')->name('produto.store');
    Route::put('produto/{id}', 'App\Http\Controllers\Api\ProdutoController@update')->name('produto.update');
    Route::delete('produto/{id}', 'App\Http\Controllers\Api\ProdutoController@destroy')->name('produto.destroy');

    // MATERIAL
    Route::get('material', 'App\Http\Controllers\Api\MateriaisController@index')->name('material.index');
    Route::get('material/{id}', 'App\Http\Controllers\Api\MateriaisController@show')->name('material.show');
    Route::post('material', 'App\Http\Controllers\Api\MateriaisController@store')->name('material.store');
    Route::put('material/{id}', 'App\Http\Controllers\Api\MateriaisController@update')->name('material.update');
    Route::delete('material/{id}', 'App\Http\Controllers\Api\MateriaisController@destroy')->name('material.destroy');

    //GEOLOCALIZAÇÃO
    Route::get('geo', 'App\Http\Controllers\Api\GeoCepController@index')->name('geo.index');

});
