<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Usuario extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * Tabela usada pelo model.
     *
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * Atributos assinados em massa.
     *
     * @var array
     */
    protected $fillable = ['usuario', 'senha'];

    /**
     * Retorna senha
     */
    public function getAuthPassword() {
        return $this->senha;
    }
}
