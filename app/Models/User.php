<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    const int PERMISSAO_USUARIO = 1;
    const int PERMISSAO_SUPERADMIN = 99;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf_cnpj',
        'imagem'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function carregarDadosNaSessao(User $user)
    {
        session(
            [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'imagem' => $user->imagem,
                    'permissao' => $user->permissao,
                ],
                'image_location' => env('IMAGE_LOCATION')
            ]
        );
    }

    public function contatos()
    {
        return $this->hasMany(Contato::class);
    }

    public function telefones()
    {
        return $this->hasMany(Telefone::class);
    }
}
