<?php

namespace App\Rules;

use App\Models\User;
use App\Services\Funcoes;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidatorCpfCnpj implements ValidationRule
{

    public function __construct() {}
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $value);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            $fail('CPF tem que ter 11 dígitos.');
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $fail('CPF incorreto.');
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $fail('CPF incorreto.');
            }
        }
    }
}
