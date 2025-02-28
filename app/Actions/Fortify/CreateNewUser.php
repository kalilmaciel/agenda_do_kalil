<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Services\Funcoes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'imagem' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048']
        ])->validate();

        if (array_key_exists('foto', $input)) {
            $imagem = Funcoes::uploadImagem($input['foto'], 'agenda/usuarios');
            if ($imagem) {
                $input['imagem'] = $imagem;
            }
        } else {
            $input['imagem'] = null;
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'cpf_cnpj' => $input['cpf_cnpj'],
            'password' => Hash::make($input['password']),
            'imagem' => $input['imagem']
        ]);
    }
}
