<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'rg',
        'cargo',
        'celular',
        'fixo',
        'whats',
        'endereco',
        'numero',
        'complemento',
        'cep',
        'bairro',
        'cidade',
        'estado',
        'registro_carteira',
        'tipo_carteira',
        'validade_carteira',
        'ativo',
        'identificador_celular',
        'usuario_responsavel_cadastro_id',
        'pessoa_juridica_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function usuario_responsavel_cadastro()
    {
        return $this->hasOne('App\Models\User', 'usuario_responsavel_cadastro_id', 'id');
    }

    public function pessoa_juridica()
    {
        return $this->hasOne('App\Models\PessoaJuridica', 'id', 'pessoa_juridica_id');
    }

    public function OauthAccessToken()
    {
        return $this->hasMany('App\Models\OauthAccessToken');
    }

    public function assignRole($roles, string $guard = null)
    {
        $roles = \is_string($roles) ? [$roles] : $roles;
        $guard = $guard ? : $this->getDefaultGuardName();

        $roles = collect($roles)
            ->flatten()
            ->map(function ($role) use ($guard) {
                return $this->getStoredRole($role, $guard);
            })
            ->each(function ($role) {
                $this->ensureModelSharesGuard($role);
            })
            ->all();

        $this->roles()->saveMany($roles);

        $this->forgetCachedPermissions();

        return $this;
    }

    public function removeRole($role, string $guard = null)
    {
        $guard = $guard ? : $this->getDefaultGuardName();

        $this->roles()->detach($this->getStoredRole($role, $guard));

        $this->load('roles');

        if (is_a($this, get_class($this->getPermissionClass()))) {
            $this->forgetCachedPermissions();
        }

        return $this;
    }

    protected function getStoredRole($role, string $guard): Role
    {
        if (is_numeric($role)) {
            return app(Role::class)->findById($role, $guard);
        }

        if (is_string($role)) {
            return app(Role::class)->findByName($role, $guard);
        }

        return $role;
    }
}
