<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserReslogoutource;



Route::post('login','App\Http\Controllers\Api\UserController@accessToken')->name('api.login');

Route::middleware(['auth:api', 'permission'])->group(function() {
    // AUTHENTICATED USER
    Route::get('logout', 'App\Http\Controllers\Api\UserController@logout')->name('api.logout');

    // PROFILE
    Route::get('profile/me', 'App\Http\Controllers\Api\ProfileController@me')->name('profile.me');
    Route::put('profile/password', 'App\Http\Controllers\Api\ProfileController@password')->name('profile.password');
    Route::put('profile', 'App\Http\Controllers\Api\ProfileController@update')->name('profile.atualizar');

    // USERS
    Route::get('users', 'App\Http\Controllers\Api\UserController@index')->name('usuarios.lista');
    Route::get('users/{id}', 'App\Http\Controllers\Api\UserController@show')->name('usuarios.mostrar');
    Route::post('users', 'App\Http\Controllers\Api\UserController@store')->name('usuarios.criar');
    Route::put('users/{id}', 'App\Http\Controllers\Api\UserController@update')->name('usuarios.atualizar');
    Route::delete('users/{id}', 'App\Http\Controllers\Api\UserController@destroy')->name('usuarios.excluir');

    // ROLES
    Route::get('roles', 'App\Http\Controllers\Api\RoleController@index')->name('funcoes.lista');
    Route::get('roles/{id}', 'App\Http\Controllers\Api\RoleController@show')->name('funcoes.mostrar');
    Route::post('roles', 'App\Http\Controllers\Api\RoleController@store')->name('funcoes.criar');
    Route::put('roles/{id}', 'App\Http\Controllers\Api\RoleController@update')->name('funcoes.atualizar');
    Route::delete('roles/{id}', 'App\Http\Controllers\Api\RoleController@destroy')->name('funcoes.excluir');

    // PERMISSIONS
    Route::get('permissions', 'App\Http\Controllers\Api\PermissionController@index')->name('permissoes.lista');
    Route::get('permissions/{id}', 'App\Http\Controllers\Api\PermissionController@show')->name('permissoes.mostrar');
    Route::post('permissions', 'App\Http\Controllers\Api\PermissionController@store')->name('permissoes.criar');
    Route::put('permissions/{id}', 'App\Http\Controllers\Api\PermissionController@update')->name('permissoes.atualizar');
    Route::delete('permissions/{id}', 'App\Http\Controllers\Api\PermissionController@destroy')->name('permissoes.excluir');

    // ACONDICIONAMENTO
    Route::get('acondicionamento', 'App\Http\Controllers\Api\AcondicionamentoController@index')->name('acondicionamento.lista');
    Route::get('acondicionamento/{id}', 'App\Http\Controllers\Api\AcondicionamentoController@show')->name('acondicionamento.mostrar');
    Route::post('acondicionamento', 'App\Http\Controllers\Api\AcondicionamentoController@store')->name('acondicionamento.criar');
    Route::put('acondicionamento/{id}', 'App\Http\Controllers\Api\AcondicionamentoController@update')->name('acondicionamento.atualizar');
    Route::delete('acondicionamento/{id}', 'App\Http\Controllers\Api\AcondicionamentoController@destroy')->name('acondicionamento.excluir');
    Route::put('acondicionamento/{id}/status', 'App\Http\Controllers\Api\AcondicionamentoController@updateStatus')->name('acondicionamento.atualizar_status');

    // ATIVIDADE
    Route::get('atividade', 'App\Http\Controllers\Api\AtividadeController@index')->name('atividade.lista');
    Route::get('atividade/{id}', 'App\Http\Controllers\Api\AtividadeController@show')->name('atividade.mostrar');
    Route::post('atividade', 'App\Http\Controllers\Api\AtividadeController@store')->name('atividade.criar');
    Route::put('atividade/{id}', 'App\Http\Controllers\Api\AtividadeController@update')->name('atividade.atualizar');
    Route::delete('atividade/{id}', 'App\Http\Controllers\Api\AtividadeController@destroy')->name('atividade.excluir');
    Route::put('atividade/{id}/status', 'App\Http\Controllers\Api\AtividadeController@updateStatus')->name('atividade.atualizar_status');

    // TRATAMENTO
    Route::get('tratamento', 'App\Http\Controllers\Api\TratamentoController@index')->name('tratamento.lista');
    Route::get('tratamento/{id}', 'App\Http\Controllers\Api\TratamentoController@show')->name('tratamento.mostrar');
    Route::post('tratamento', 'App\Http\Controllers\Api\TratamentoController@store')->name('tratamento.criar');
    Route::put('tratamento/{id}', 'App\Http\Controllers\Api\TratamentoController@update')->name('tratamento.atualizar');
    Route::delete('tratamento/{id}', 'App\Http\Controllers\Api\TratamentoController@destroy')->name('tratamento.excluir');
    Route::put('tratamento/{id}/status', 'App\Http\Controllers\Api\TratamentoController@updateStatus')->name('tratamento.atualizar_status');

    // UNIDAD
    Route::get('unidad', 'App\Http\Controllers\Api\UnidadController@index')->name('unidad.lista');
    Route::get('unidad/{id}', 'App\Http\Controllers\Api\UnidadController@show')->name('unidad.mostrar');
    Route::post('unidad', 'App\Http\Controllers\Api\UnidadController@store')->name('unidad.criar');
    Route::put('unidad/{id}', 'App\Http\Controllers\Api\UnidadController@update')->name('unidad.atualizar');
    Route::delete('unidad/{id}', 'App\Http\Controllers\Api\UnidadController@destroy')->name('unidad.excluir');
    Route::put('unidad/{id}/status', 'App\Http\Controllers\Api\UnidadController@updateStatus')->name('unidad.atualizar_status');

    // MARCA
    Route::get('marca', 'App\Http\Controllers\Api\MarcaController@index')->name('marca.lista');
    Route::get('marca/{id}', 'App\Http\Controllers\Api\MarcaController@show')->name('marca.mostrar');
    Route::post('marca', 'App\Http\Controllers\Api\MarcaController@store')->name('marca.criar');
    Route::put('marca/{id}', 'App\Http\Controllers\Api\MarcaController@update')->name('marca.atualizar');
    Route::delete('marca/{id}', 'App\Http\Controllers\Api\MarcaController@destroy')->name('marca.excluir');
    Route::put('marca/{id}/status', 'App\Http\Controllers\Api\MarcaController@updateStatus')->name('marca.atualizar_status');

    // MODELO
    Route::get('modelo', 'App\Http\Controllers\Api\ModeloController@index')->name('modelo.lista');
    Route::get('modelo/{id}', 'App\Http\Controllers\Api\ModeloController@show')->name('modelo.mostrar');
    Route::post('modelo', 'App\Http\Controllers\Api\ModeloController@store')->name('modelo.criar');
    Route::put('modelo/{id}', 'App\Http\Controllers\Api\ModeloController@update')->name('modelo.atualizar');
    Route::delete('modelo/{id}', 'App\Http\Controllers\Api\ModeloController@destroy')->name('modelo.excluir');
    Route::put('modelo/{id}/status', 'App\Http\Controllers\Api\ModeloController@updateStatus')->name('modelo.atualizar_status');

    // EMPRESA
    Route::get('pessoa_juridica', 'App\Http\Controllers\Api\PessoaJuridicaController@index')->name('pessoa_juridica.lista');
    Route::get('pessoa_juridica/{id}', 'App\Http\Controllers\Api\PessoaJuridicaController@show')->name('pessoa_juridica.mostrar');
    Route::post('pessoa_juridica', 'App\Http\Controllers\Api\PessoaJuridicaController@store')->name('pessoa_juridica.criar');
    Route::put('pessoa_juridica/{id}', 'App\Http\Controllers\Api\PessoaJuridicaController@update')->name('pessoa_juridica.atualizar');
    Route::delete('pessoa_juridica/{id}', 'App\Http\Controllers\Api\PessoaJuridicaController@destroy')->name('pessoa_juridica.excluir');
    Route::put('pessoa_juridica/{id}/status', 'App\Http\Controllers\Api\PessoaJuridicaController@updateStatus')->name('pessoa_juridica.atualizar_status');

    // VEICULOS
    Route::get('veiculo', 'App\Http\Controllers\Api\VeiculoController@index')->name('veiculo.lista');
    Route::get('veiculo/{id}', 'App\Http\Controllers\Api\VeiculoController@show')->name('veiculo.mostrar');
    Route::post('veiculo', 'App\Http\Controllers\Api\VeiculoController@store')->name('veiculo.criar');
    Route::put('veiculo/{id}', 'App\Http\Controllers\Api\VeiculoController@update')->name('veiculo.atualizar');
    Route::delete('veiculo/{id}', 'App\Http\Controllers\Api\VeiculoController@destroy')->name('veiculo.excluir');
    Route::put('veiculo/{id}/status', 'App\Http\Controllers\Api\VeiculoController@updateStatus')->name('veiculo.atualizar_status');

    // ESTAGIOS OS
    Route::get('estagio_os', 'App\Http\Controllers\Api\EstagiosOsController@index')->name('estagio_os.lista');
    Route::get('estagio_os/{id}', 'App\Http\Controllers\Api\EstagiosOsController@show')->name('estagio_os.mostrar');
    Route::post('estagio_os', 'App\Http\Controllers\Api\EstagiosOsController@store')->name('estagio_os.criar');
    Route::put('estagio_os/{id}', 'App\Http\Controllers\Api\EstagiosOsController@update')->name('estagio_os.atualizar');
    Route::delete('estagio_os/{id}', 'App\Http\Controllers\Api\EstagiosOsController@destroy')->name('estagio_os.excluir');

    // TIPO CLASSES DE SUCATAS
    Route::get('classe_sucata', 'App\Http\Controllers\Api\ClasseSucataController@index')->name('classe_sucata.lista');
    Route::get('classe_sucata/{id}', 'App\Http\Controllers\Api\ClasseSucataController@show')->name('classe_sucata.mostrar');
    Route::post('classe_sucata', 'App\Http\Controllers\Api\ClasseSucataController@store')->name('classe_sucata.criar');
    Route::put('classe_sucata/{id}', 'App\Http\Controllers\Api\ClasseSucataController@update')->name('classe_sucata.atualizar');
    Route::delete('classe_sucata/{id}', 'App\Http\Controllers\Api\ClasseSucataController@destroy')->name('classe_sucata.excluir');

    // TIPO CLASSE DE MATERIAIS
    Route::get('tipo_materiais', 'App\Http\Controllers\Api\TipoMaterialController@index')->name('tipo_materiais.lista');
    Route::get('tipo_materiais/{id}', 'App\Http\Controllers\Api\TipoMaterialController@show')->name('tipo_materiais.mostrar');
    Route::post('tipo_materiais', 'App\Http\Controllers\Api\TipoMaterialController@store')->name('tipo_materiais.criar');
    Route::put('tipo_materiais/{id}', 'App\Http\Controllers\Api\TipoMaterialController@update')->name('tipo_materiais.atualizar');
    Route::delete('tipo_materiais/{id}', 'App\Http\Controllers\Api\TipoMaterialController@destroy')->name('tipo_materiais.excluir');

    // OS 
    Route::get('os', 'App\Http\Controllers\Api\OrdenDeServicoController@index')->name('os.lista');
    Route::get('os/{id}', 'App\Http\Controllers\Api\OrdenDeServicoController@show')->name('os.mostrar');
    Route::post('os', 'App\Http\Controllers\Api\OrdenDeServicoController@store')->name('os.criar');
    Route::put('os/{id}', 'App\Http\Controllers\Api\OrdenDeServicoController@update')->name('os.atualizar');
    Route::delete('os/{id}', 'App\Http\Controllers\Api\OrdenDeServicoController@destroy')->name('os.excluir');
    Route::put('os/{id}/estagio', 'App\Http\Controllers\Api\OrdenDeServicoController@updateEstagio')->name('os.atualizar_estagio');

    // NOTAS FISCAIS
    Route::get('nota_fiscais', 'App\Http\Controllers\Api\NotaFiscalController@index')->name('nota.lista');
    Route::get('nota_fiscais/{id}', 'App\Http\Controllers\Api\NotaFiscalController@show')->name('nota.mostrar');
    Route::post('nota_fiscais', 'App\Http\Controllers\Api\NotaFiscalController@store')->name('nota.criar');
    Route::put('nota_fiscais/{id}', 'App\Http\Controllers\Api\NotaFiscalController@update')->name('nota.atualizar');
    Route::delete('nota_fiscais/{id}', 'App\Http\Controllers\Api\NotaFiscalController@destroy')->name('nota.excluir');

    // TIPO EMPRESA
    Route::get('tipo_empresa', 'App\Http\Controllers\Api\TipoEmpresaController@index')->name('tipo_empresa.lista');
    Route::get('tipo_empresa/{id}', 'App\Http\Controllers\Api\TipoEmpresaController@show')->name('tipo_empresa.mostrar');
    Route::post('tipo_empresa', 'App\Http\Controllers\Api\TipoEmpresaController@store')->name('tipo_empresa.criar');
    Route::put('tipo_empresa/{id}', 'App\Http\Controllers\Api\TipoEmpresaController@update')->name('tipo_empresa.atualizar');
    Route::delete('tipo_empresa/{id}', 'App\Http\Controllers\Api\TipoEmpresaController@destroy')->name('tipo_empresa.excluir');
    Route::put('tipo_empresa/{id}/status', 'App\Http\Controllers\Api\TipoEmpresaController@updateStatus')->name('tipo_empresa.atualizar_status');
    
    // PRODUTO
    Route::get('produto', 'App\Http\Controllers\Api\ProdutoController@index')->name('produto.lista');
    Route::get('produto/{id}', 'App\Http\Controllers\Api\ProdutoController@show')->name('produto.mostrar');
    Route::post('produto', 'App\Http\Controllers\Api\ProdutoController@store')->name('produto.criar');
    Route::put('produto/{id}', 'App\Http\Controllers\Api\ProdutoController@update')->name('produto.atualizar');
    Route::delete('produto/{id}', 'App\Http\Controllers\Api\ProdutoController@destroy')->name('produto.excluir');
    Route::put('produto/{id}/status', 'App\Http\Controllers\Api\ProdutoController@updateStatus')->name('produto.atualizar_status');

    // MATERIAL
    Route::get('material', 'App\Http\Controllers\Api\MateriaisController@index')->name('material.lista');
    Route::get('material/{id}', 'App\Http\Controllers\Api\MateriaisController@show')->name('material.mostrar');
    Route::post('material', 'App\Http\Controllers\Api\MateriaisController@store')->name('material.criar');
    Route::put('material/{id}', 'App\Http\Controllers\Api\MateriaisController@update')->name('material.atualizar');
    Route::delete('material/{id}', 'App\Http\Controllers\Api\MateriaisController@destroy')->name('material.excluir');
    Route::put('material/{id}/status', 'App\Http\Controllers\Api\MateriaisController@updateStatus')->name('material.atualizar_status');

    // IBAMA
    Route::get('ibama', 'App\Http\Controllers\Api\IbamaController@index')->name('ibama.lista');
    Route::get('ibama/{id}', 'App\Http\Controllers\Api\IbamaController@show')->name('ibama.mostrar');
    Route::post('ibama', 'App\Http\Controllers\Api\IbamaController@store')->name('ibama.criar');
    Route::put('ibama/{id}', 'App\Http\Controllers\Api\IbamaController@update')->name('ibama.atualizar');
    Route::delete('ibama/{id}', 'App\Http\Controllers\Api\IbamaController@destroy')->name('ibama.excluir');

    // GEOLOCALIZAÇÃO
    Route::get('geo', 'App\Http\Controllers\Api\GeoCepController@index')->name('geo.lista');
    Route::post('map','App\Http\Controllers\Api\GeoCepController@SendGeo')->name('geo.enviar');

    // IMAGENS 
    Route::get('imagens', 'App\Http\Controllers\Api\ImagensController@index')->name('imagens.lista');
    Route::get('imagens/{id}', 'App\Http\Controllers\Api\ImagensController@show')->name('imagens.mostrar');
    Route::post('imagens', 'App\Http\Controllers\Api\ImagensController@store')->name('imagens.criar');
    // Route::put('imagens/{id}', 'App\Http\Controllers\Api\ImagensController@update')->name('imagens.atualizar');
    Route::delete('imagens/{id}', 'App\Http\Controllers\Api\ImagensController@destroy')->name('imagens.excluir');
});
