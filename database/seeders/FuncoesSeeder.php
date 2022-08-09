<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class FuncoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // GDT
        $role_gdt_web = Role::create(['name' => 'GDT', 'guard_name' => 'web']);
        $role_gdt_api = Role::create(['name' => 'GDT', 'guard_name' => 'api']);

        $permissions_gdt_web = Permission::where('guard_name', 'web')->whereIn('name', [
            'login', 'logout', 'home', 'imagens',
            'rastreamento.rastreamento', 'rastreamento.os', 'rastreamento.notaFiscal', 'configuracoes.usuarios', 'configuracoes.perfil',
            'cadastros.veiculo', 'cadastros.produto', 'cadastros.material', 'cadastros.empresa', 'cadastros.email',
            'administrativo.unidad', 'administrativo.tratamento', 'administrativo.tipoMaterial', 'administrativo.tipoEmpresa', 'administrativo.modelo',
            'administrativo.marca', 'administrativo.ibama', 'administrativo.estagiosOs', 'administrativo.classeSucata', 'administrativo.atividade', 'administrativo.acondicionamento',
        ])->orderBy('id', 'ASC')->get()->pluck('id')->all();

        $permissions_gdt_api = Permission::where('guard_name', 'api')->whereIn('name', [
            'veiculo.mostrar', 'veiculo.lista', 'veiculo.criar', 'veiculo.atualizar_status', 'veiculo.atualizar',
            'usuarios.mostrar', 'usuarios.lista', 'usuarios.criar', 'usuarios.atualizar',
            'unidad.mostrar', 'unidad.lista', 'unidad.criar', 'unidad.atualizar_status', 'unidad.atualizar',
            'tratamento.mostrar', 'tratamento.lista', 'tratamento.excluir', 'tratamento.criar', 'tratamento.atualizar_status', 'tratamento.atualizar',
            'tipo_materiais.mostrar', 'tipo_materiais.lista', 'tipo_materiais.excluir', 'tipo_materiais.criar', 'tipo_materiais.atualizar',
            'tipo_empresa.mostrar', 'tipo_empresa.lista', 'tipo_empresa.excluir', 'tipo_empresa.criar', 'tipo_empresa.atualizar_status', 'tipo_empresa.atualizar',
            'profile.password', 'profile.me', 'profile.atualizar',
            'produto.mostrar', 'produto.lista', 'produto.excluir', 'produto.criar', 'produto.atualizar_status', 'produto.atualizar',
            'pessoa_juridica.mostrar', 'pessoa_juridica.lista', 'pessoa_juridica.excluir', 'pessoa_juridica.criar', 'pessoa_juridica.atualizar_status', 'pessoa_juridica.atualizar',
            'permissoes.mostrar', 'permissoes.lista',
            'os.mostrar', 'os.lista', 'os.excluir', 'os.criar', 'os.atualizar',
            'nota.mostrar', 'nota.lista', 'nota.excluir', 'nota.criar', 'nota.atualizar',
            'modelo.mostrar', 'modelo.lista', 'modelo.excluir', 'modelo.criar', 'modelo.atualizar_status', 'modelo.atualizar',
            'material.mostrar', 'material.lista', 'material.excluir', 'material.criar', 'material.atualizar_status', 'material.atualizar',
            'marca.mostrar', 'marca.lista', 'marca.excluir', 'marca.criar', 'marca.atualizar_status', 'marca.atualizar',
            'imagens.show', 'imagens.criar',
            'ibama.mostrar', 'ibama.lista', 'ibama.excluir', 'ibama.criar', 'ibama.atualizar',
            'geo.lista', 'funcoes.lista',
            'estagio_os.mostrar', 'estagio_os.lista', 'estagio_os.excluir', 'estagio_os.criar', 'estagio_os.atualizar',
            'classe_sucata.mostrar', 'classe_sucata.lista', 'classe_sucata.excluir', 'classe_sucata.criar', 'classe_sucata.atualizar',
            'atividade.mostrar', 'atividade.lista', 'atividade.excluir', 'atividade.criar', 'atividade.atualizar_status', 'atividade.atualizar',
            'api.logout', 'api.login',
            'acondicionamento.mostrar', 'acondicionamento.lista', 'acondicionamento.excluir', 'acondicionamento.criar', 'acondicionamento.atualizar_status', 'acondicionamento.atualizar',
        ])->orderBy('id', 'ASC')->get()->pluck('id')->all();

        $role_gdt_web->syncPermissions($permissions_gdt_web);
        $role_gdt_api->syncPermissions($permissions_gdt_api);

        // Gerador
        $role_gerador_web = Role::create(['name' => 'gerador', 'guard_name' => 'web']);
        $role_gerador_api = Role::create(['name' => 'gerador', 'guard_name' => 'api']);

        $permissions_gerador_web = Permission::where('guard_name', 'web')->whereIn('name', [
            'login', 'logout', 'home', 'imagens',
            'configuracoes.usuarios', 'configuracoes.perfil',
            'cadastros.veiculo', 'cadastros.produto', 'cadastros.material', 'cadastros.empresa',
            'rastreamento.rastreamento', 'rastreamento.os', 'rastreamento.notaFiscal',
            'administrativo.unidad', 'administrativo.tratamento', 'administrativo.tipoMaterial', 'administrativo.tipoEmpresa', 'administrativo.modelo', 'administrativo.marca',
            'administrativo.ibama', 'administrativo.estagiosOs', 'administrativo.classeSucata', 'administrativo.atividade', 'administrativo.acondicionamento',
        ])->orderBy('id', 'ASC')->get()->pluck('id')->all();

        $permissions_gerador_api = Permission::where('guard_name', 'api')->whereIn('name', [
            'veiculo.mostrar', 'veiculo.lista', 'veiculo.excluir', 'veiculo.criar', 'veiculo.atualizar_status', 'veiculo.atualizar',
            'usuarios.mostrar', 'usuarios.lista', 'usuarios.excluir', 'usuarios.criar', 'usuarios.atualizar',
            'unidad.mostrar', 'unidad.lista', 'unidad.excluir', 'unidad.criar', 'unidad.atualizar_status', 'unidad.atualizar',
            'tratamento.mostrar', 'tratamento.lista', 'tratamento.excluir', 'tratamento.criar', 'tratamento.atualizar_status', 'tratamento.atualizar',
            'tipo_materiais.mostrar', 'tipo_materiais.lista', 'tipo_materiais.excluir', 'tipo_materiais.criar', 'tipo_materiais.atualizar',
            'tipo_empresa.mostrar', 'tipo_empresa.lista', 'tipo_empresa.excluir', 'tipo_empresa.criar', 'tipo_empresa.atualizar_status', 'tipo_empresa.atualizar',
            'profile.password', 'profile.me', 'profile.atualizar',
            'produto.mostrar', 'produto.lista', 'produto.excluir', 'produto.criar', 'produto.atualizar_status', 'produto.atualizar',
            'pessoa_juridica.mostrar', 'pessoa_juridica.lista', 'pessoa_juridica.excluir', 'pessoa_juridica.criar', 'pessoa_juridica.atualizar_status', 'pessoa_juridica.atualizar',
            'permissoes.mostrar,' 'permissoes.lista',
            'os.mostrar', 'os.lista', 'os.excluir', 'os.criar', 'os.atualizar',
            'nota.mostrar', 'nota.lista', 'nota.excluir', 'nota.criar', 'nota.atualizar',
            'modelo.mostrar', 'modelo.lista', 'modelo.excluir', 'modelo.criar', 'modelo.atualizar_status', 'modelo.atualizar',
            'material.mostrar', 'material.lista', 'material.excluir', 'material.criar', 'material.atualizar_status', 'material.atualizar',
            'marca.mostrar', 'marca.lista', 'marca.excluir', 'marca.criar', 'marca.atualizar_status', 'marca.atualizar',
            'imagens.show', 'imagens.criar',
            'ibama.mostrar', 'ibama.lista', 'ibama.excluir', 'ibama.criar', 'ibama.atualizar',
            'geo.lista',
            'funcoes.mostrar', 'funcoes.lista',
            'estagio_os.mostrar', 'estagio_os.lista', 'estagio_os.excluir', 'estagio_os.criar', 'estagio_os.atualizar',
            'classe_sucata.mostrar', 'classe_sucata.lista', 'classe_sucata.excluir', 'classe_sucata.criar', 'classe_sucata.atualizar',
            'atividade.mostrar', 'atividade.lista', 'atividade.excluir', 'atividade.criar', 'atividade.atualizar_status', 'atividade.atualizar',
            'api.logout', 'api.login',
            'acondicionamento.mostrar', 'acondicionamento.lista', 'acondicionamento.excluir', 'acondicionamento.criar', 'acondicionamento.atualizar_status', 'acondicionamento.atualizar',
        ])->orderBy('id', 'ASC')->get()->pluck('id')->all();

        $role_gerador_web->syncPermissions($permissions_gerador_web);
        $role_gerador_api->syncPermissions($permissions_gerador_api);

        // Destinador
        $role_destinador_web = Role::create(['name' => 'destinador', 'guard_name' => 'web']);
        $role_destinador_api = Role::create(['name' => 'destinador', 'guard_name' => 'api']);

        $permissions_destinador_web = Permission::where('guard_name', 'web')->whereIn('name', [
            'login', 'logout', 'home', 'imagens', 'configuracoes.perfil',
            'rastreamento.rastreamento', 'rastreamento.os', 'cadastros.empresa',
        ])->orderBy('id', 'ASC')->get()->pluck('id')->all();

        $permissions_destinador_api = Permission::where('guard_name', 'api')->whereIn('name', [
            'veiculo.lista', 'usuarios.mostrar', 'usuarios.lista', 'usuarios.criar', 'usuarios.atualizar',
            'tipo_empresa.lista', 'profile.password', 'profile.me', 'profile.atualizar',
            'pessoa_juridica.mostrar', 'pessoa_juridica.lista', 'pessoa_juridica.criar', 'pessoa_juridica.atualizar_status', 'pessoa_juridica.atualizar',
            'permissoes.lista', 'os.mostrar', 'os.lista', 'os.atualizar', 'nota.lista', 'imagens.show', 'imagens.criar', 'geo.lista',
            'funcoes.lista', 'estagio_os.mostrar', 'estagio_os.lista', 'estagio_os.atualizar', 'atividade.lista', 'api.logout', 'api.login',
        ])->orderBy('id', 'ASC')->get()->pluck('id')->all();

        $role_destinador_web->syncPermissions($permissions_destinador_web);
        $role_destinador_api->syncPermissions($permissions_destinador_api);

        // Transportador
        // $role_transportador_web = Role::create(['name' => 'transportador', 'guard_name' => 'web']);
        // $role_transportador_api = Role::create(['name' => 'transportador', 'guard_name' => 'api']);

        // $permissions_transportador_web = Permission::where('guard_name', 'web')->pluck('id')->all();
        // $permissions_transportador_api = Permission::where('guard_name', 'api')->pluck('id')->all();

        // $role_transportador_web->syncPermissions($permissions_transportador_web);
        // $role_transportador_api->syncPermissions($permissions_transportador_api);

        // Motorista
        $role_motorista_web = Role::create(['name' => 'motorista', 'guard_name' => 'web']);
        $role_motorista_api = Role::create(['name' => 'motorista', 'guard_name' => 'api']);

        $permissions_motorista_web = Permission::where('guard_name', 'web')->whereIn('name', [
            'rastreamento.rastreamento', 'rastreamento.os', 'logout', 'login', 'home', 'configuracoes.perfil',
        ])->orderBy('id', 'ASC')->get()->pluck('id')->all();

        $permissions_motorista_api = Permission::where('guard_name', 'api')->whereIn('name', [
            'veiculo.lista', 'usuarios.lista', 'profile.password', 'profile.me', 'profile.atualizar', 'pessoa_juridica.lista', 'os.mostrar', 'os.lista', 'os.atualizar',
            'geo.lista', 'funcoes.lista', 'estagio_os.lista', 'estagio_os.atualizar', 'api.logout', 'api.login',
        ])->orderBy('id', 'ASC')->get()->pluck('id')->all();

        $role_motorista_web->syncPermissions($permissions_motorista_web);
        $role_motorista_api->syncPermissions($permissions_motorista_api);
    }
}