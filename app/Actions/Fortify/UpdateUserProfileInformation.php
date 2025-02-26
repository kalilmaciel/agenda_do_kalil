<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Services\Funcoes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'cpf_cnpj' => ['required', 'string', Rule::unique('users')->ignore($user->id),],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'foto' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ])->validateWithBag('updateProfileInformation');

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {

            $imagem = Funcoes::uploadImagem($input['foto'], 'agenda/usuarios');
            if ($imagem) {
                $user->imagem = $imagem;
            }

            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'cpf_cnpj' => Funcoes::onlyNumbers($input['cpf_cnpj']),
                'cep' => Funcoes::onlyNumbers($input['cep']),
                'endereco' => $input['endereco'],
                'complemento' => $input['complemento'],
                'bairro' => $input['bairro'],
                'cidade' => $input['cidade'],
                'uf' => $input['uf'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
