<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'O campo :attribute deve ser aceito.',
    'accepted_if' => 'O campo :attribute deve ser aceito quando :other estiver :value.',
    'active_url' => 'O campo :attribute deve ser uma URL válida.',
    'after' => 'O campo :attribute deve ser uma data após :date.',
    'after_or_equal' => 'O campo :attribute deve ter uma data igual ou após :date.',
    'alpha' => 'O campo :attribute deve conter apenas letras.',
    'alpha_dash' => 'O campo :attribute deve conter apenas letras, números, traços, and sublinhados.',
    'alpha_num' => 'O campo :attribute deve conter apenas letras e números.',
    'array' => 'O campo :attribute deve ser um array.',
    'ascii' => 'O campo :attribute deve conter apenas caracteres alfanuméricos e símbolos.',
    'before' => 'O campo :attribute deve ser uma data antes de :date.',
    'before_or_equal' => 'O campo :attribute deve ser uma data antes ou igual a :date.',
    'between' => [
        'array' => 'O campo :attribute deve estar entre :min e :max .',
        'file' => 'O campo :attribute deve estar entre :min e :max kilobytes.',
        'numeric' => 'O campo :attribute deve estar entre :min e :max.',
        'string' => 'O campo :attribute deve estar entre :min e :max caracteres.',
    ],
    'boolean' => 'O campo :attribute deve ser verdadeiro ou falso.',
    'can' => 'O campo :attribute field contem um valor não autorizado.',
    'confirmed' => 'O campo :attribute não bate com sua confirmação.',
    'contains' => 'O campo :attribute necessita de um valor que está faltando.',
    'current_password' => 'a senha está incorreta.',
    'date' => 'O campo :attribute deve ter uma data válida.',
    'date_equals' => 'O campo :attribute deve ter uma data igual a :date.',
    'date_format' => 'O campo :attribute deve corresponder com o formato :format.',
    'decimal' => 'O campo :attribute deve ter :decimal casas decimais.',
    'declined' => 'O campo :attribute deve ser aceito.',
    'declined_if' => 'O campo :attribute deve ser aceito quando :other for :value.',
    'different' => 'O campo :attribute e :other devem ser diferentes.',
    'digits' => 'O campo :attribute deve ter :digits dígitos.',
    'digits_between' => 'O campo :attribute deve ter entre :min e :max dígitos.',
    'dimensions' => 'O campo :attribute tem uma imagem com dimensões inválidas.',
    'distinct' => 'O campo :attribute tem um valor duplicado.',
    'doesnt_end_with' => 'O campo :attribute não deve finalizar com um dos seguintes valores: :values.',
    'doesnt_start_with' => 'O campo :attribute não deve iniciar com um dos seguintes valores: :values.',
    'email' => 'O campo :attribute deve ter um endereço de e-mail válido.',
    'ends_with' => 'O campo :attribute deve finalizar com um dos seguintes valores: :values.',
    'enum' => 'O valor selecionado :attribute é inválido.',
    'exists' => 'O valor selecionado :attribute é inválido.',
    'extensions' => 'O campo :attribute deve ter uma das seguintes extensões: :values.',
    'file' => 'O campo :attribute deve ser a arquivo.',
    'filled' => 'O campo :attribute deve ter um valor.',
    'gt' => [
        'array' => 'O campo :attribute deve ter mais que :value itess.',
        'file' => 'O campo :attribute deve ser maior que :value kilobytes.',
        'numeric' => 'O campo :attribute deve ser maior que :value.',
        'string' => 'O campo :attribute deve ser maior que :value caracteres.',
    ],
    'gte' => [
        'array' => 'O campo :attribute deve ter :value itens ou mais.',
        'file' => 'O campo :attribute deve ser maior ou igual a :value kilobytes.',
        'numeric' => 'O campo :attribute deve ser maior ou igual a :value.',
        'string' => 'O campo :attribute deve ser maior ou igual a :value caracteres.',
    ],
    'hex_color' => 'O campo :attribute deve ser uma cor hexadecimal válida.',
    'image' => 'O campo :attribute deve ser uma imagem.',
    'in' => 'O valor selecionado :attribute é inválido.',
    'in_array' => 'O campo :attribute deve exixtir em :other.',
    'integer' => 'O campo :attribute deve ser um inteiro.',
    'ip' => 'O campo :attribute deve ser um endereço de IP.',
    'ipv4' => 'O campo :attribute deve ser um endereço de IPv4 válido.',
    'ipv6' => 'O campo :attribute deve ser um endereço de IPv6 válido.',
    'json' => 'O campo :attribute deve ser um string de JSON válido.',
    'list' => 'O campo :attribute deve ser uma lista.',
    'lowercase' => 'O campo :attribute deve ser minúsculo.',
    'lt' => [
        'array' => 'O campo :attribute dete ser menor que :value itens.',
        'file' => 'O campo :attribute deve ter menos que :value kilobytes.',
        'numeric' => 'O campo :attribute deve ter menos que :value.',
        'string' => 'O campo :attribute deve ter menos que :value caracteres.',
    ],
    'lte' => [
        'array' => 'O campo :attribute não deve ser maior que :value items.',
        'file' => 'O campo :attribute deve ter menos que ou igual a :value kilobytes.',
        'numeric' => 'O campo :attribute deve ter menos que ou igual a :value.',
        'string' => 'O campo :attribute deve ter menos que ou igual a :value characters.',
    ],
    'mac_address' => 'O campo :attribute deve ser um endereço MAC válido.',
    'max' => [
        'array' => 'O campo :attribute não deve ter mais que :max itens.',
        'file' => 'O campo :attribute field não deve ser maior que :max kilobytes.',
        'numeric' => 'O campo :attribute field não deve ser maior que :max.',
        'string' => 'O campo :attribute field não deve ser maior que :max caracteres.',
    ],
    'max_digits' => 'O campo :attribute não deve ter mais que :max dígitos.',
    'mimes' => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes' => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'min' => [
        'array' => 'O campo :attribute deve ter pelo menos :min items.',
        'file' => 'O campo :attribute deve ter pelo menos :min kilobytes.',
        'numeric' => 'O campo :attribute deve ter pelo menos :min.',
        'string' => 'O campo :attribute deve ter pelo menos :min caracteres.',
    ],
    'min_digits' => 'O campo :attribute deve ter pelo menos :min digits.',
    'missing' => 'O campo :attribute deve estar ausente.',
    'missing_if' => 'O campo :attribute deve estar ausente quando :other for :value.',
    'missing_unless' => 'O campo :attribute deve estar ausente a menos que :other seja :value.',
    'missing_with' => 'O campo :attribute deve estar ausente quando :values estiver presente.',
    'missing_with_all' => 'Os campos :attribute devem estar ausentes quando :values estiverem presentes.',
    'multiple_of' => 'O campo :attribute deve ser um multiplo de :value.',
    'not_in' => 'o valor selecionado de :attribute é inválido.',
    'not_regex' => 'O campo :attribute tem seu formato inválido.',
    'numeric' => 'O campo :attribute deve ser um númeror.',
    'password' => [
        'letters' => 'O campo :attribute deve conter pelo menos uma letra.',
        'mixed' => 'O campo :attribute deve conter pelo menos uma letra em maiúscula e uma em minúscula.',
        'numbers' => 'O campo :attribute deve conter pelo menos um número.',
        'symbols' => 'O campo :attribute deve conter pelo menos um símbolo.',
        'uncompromised' => 'O valor :attribute apareceu em um vazamento de dados. Por favor escolha um valor diferente para :attribute.',
    ],
    'present' => 'O campo :attribute deve estar presente.',
    'present_if' => 'O campo :attribute deve estar presente quando :other for :value.',
    'present_unless' => 'O campo :attribute deve estar presente a menos que :other seja :value.',
    'present_with' => 'O campo :attribute deve estar presente quando :values estiver presente.',
    'present_with_all' => 'Os campos :attribute devem estar presentes quando :values estiverem presentes.',
    'prohibited' => 'O campo :attribute é proibido.',
    'prohibited_if' => 'O campo :attribute field é proibido quando :other for :value.',
    'prohibited_if_accepted' => 'O campo :attribute field é proibido quando :other for aceito.',
    'prohibited_if_declined' => 'O campo :attribute field é proibido quando :other for negado.',
    'prohibited_unless' => 'O campo :attribute field é proibido a menos que :other esteja em :values.',
    'prohibits' => 'O campo :attribute proibe que :other esteja presente.',
    'regex' => 'O campo :attribute tem um formato inválido.',
    'required' => 'O campo :attribute é obrigatório.',
    'required_array_keys' => 'O campo :attribute deve conter entradas para: :values.',
    'required_if' => 'O campo :attribute é obrigatório quando :other for :value.',
    'required_if_accepted' => 'O campo :attribute é obrigatório quando :other for aceito.',
    'required_if_declined' => 'O campo :attribute é obrigatório quando :other for negado.',
    'required_unless' => 'O campo :attribute é obrigatório a menos que :other esteja em :values.',
    'required_with' => 'O campo :attribute é obrigatório quando :values estiver presente.',
    'required_with_all' => 'Os campos :attribute são obrigatórios quando :values estiverem presentes.',
    'required_without' => 'O campo :attribute é obrigatório quando :values não estiverem presentes.',
    'required_without_all' => 'O campo :attribute é obrigatório quando none of :values estiverem presentes.',
    'same' => 'O campo :attribute deve ser o mesmo que :other.',
    'size' => [
        'array' => 'O campo :attribute deve conter :size itens.',
        'file' => 'O campo :attribute deve ser :size kilobytes.',
        'numeric' => 'O campo :attribute deve ter :size.',
        'string' => 'O campo :attribute deve ter :size caracteres.',
    ],
    'starts_with' => 'O campo :attribute deve iniciar com um dos seguintes valores: :values.',
    'string' => 'O campo :attribute deve ser uma string.',
    'timezone' => 'O campo :attribute deve ser timezone válido.',
    'unique' => 'O campo :attribute já existe.',
    'uploaded' => 'O campo :attribute falhou ao fazer o upload.',
    'uppercase' => 'O campo :attribute deve ser maiúsculo.',
    'url' => 'O campo :attribute deve ser uma URL válida.',
    'ulid' => 'O campo :attribute deve ser uma ULID válida.',
    'uuid' => 'O campo :attribute deve ser uma UUID válida.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
