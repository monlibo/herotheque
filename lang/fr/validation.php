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

    'accepted' => 'Le champs :attribute doit être accepté.',
    'accepted_if' => 'Le champs :attribute doit Le champs être accepté tantque :other est :value.',
    'active_url' => ' Le champs :attribute n\'est pas un URL valide.',
    'after' => 'Le champs :attribute doit être une date postérieure :date.',
    'after_or_equal' => 'Le champs :attribute doit être une date postérieure ou égale à :date.',
    'alpha' => 'Le champs :attribute ne doit contenir que des lettres.',
    'alpha_dash' => 'Le champs :attribute ne doit contenir que des lettres, des chiffres, des tirets et des traits de soulignement.',
    'alpha_num' => 'Le champs :attribute ne doit contenir que des lettres et des chiffres.',
    'array' => 'Le champs :attribute doit être un tableau.',
    'before' => 'Le champs :attribute doit être une date avant :date.',
    'before_or_equal' => 'Le champs :attribute doit être une date antérieure ou égale à :date.',
    'between' => [
        'numeric' => 'Le champs :attribute doit être compris entre :min et :max.',
        'file' => 'Le champs :attribute doit être entre :min et :max kilo-octets.',
        'string' => 'Le champs :attribute doit être entre :min et :max charactères.',
        'array' => 'The :attribute doit être entre :min and :max éléments.',
    ],
    'boolean' => 'Le champs :attribute  doit être vrai ou faux',
    'confirmed' => 'Le champs :attribute confirmation does not match.',
    'current_password' => 'Le champs password is incorrect.',
    'date' => 'Le champs :attribute is not a valid date.',
    'date_equals' => 'Le champs :attribute must be a date equal to :date.',
    'date_format' => 'Le champs :attribute does not match the format :format.',
    'declined' => 'Le champs :attribute must be declined.',
    'declined_if' => 'Le champs :attribute must be declined when :other is :value.',
    'different' => 'Le champs :attribute and :other must be different.',
    'digits' => 'Le champs :attribute must be :digits digits.',
    'digits_between' => 'Le champs :attribute must be between :min and :max digits.',
    'dimensions' => 'Le champs :attribute has invalid image dimensions.',
    'distinct' => 'Le champs :attribute field has a duplicate value.',
    'email' => 'Le champs :attribute must be a valid email address.',
    'ends_with' => 'Le champs :attribute must end with one of the following: :values.',
    'enum' => 'Le champs selected :attribute is invalid.',
    'exists' => 'Le champs selected :attribute is invalid.',
    'file' => 'Le champs :attribute must be a file.',
    'filled' => 'Le champs :attribute field must have a value.',
    'gt' => [
        'numeric' => 'Le champs :attribute must be greater than :value.',
        'file' => 'Le champs :attribute must be greater than :value kilobytes.',
        'string' => 'Le champs :attribute must be greater than :value characters.',
        'array' => 'Le champs :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'Le champs :attribute must be greater than or equal to :value.',
        'file' => 'Le champs :attribute must be greater than or equal to :value kilobytes.',
        'string' => 'Le champs :attribute must be greater than or equal to :value characters.',
        'array' => 'Le champs :attribute must have :value items or more.',
    ],
    'image' => 'Le champs :attribute must be an image.',
    'in' => 'Le champs selected :attribute is invalid.',
    'in_array' => 'Le champs :attribute field does not exist in :other.',
    'integer' => 'Le champs :attribute must be an integer.',
    'ip' => 'Le champs :attribute must be a valid IP address.',
    'ipv4' => 'Le champs :attribute must be a valid IPv4 address.',
    'ipv6' => 'Le champs :attribute must be a valid IPv6 address.',
    'json' => 'Le champs :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'Le champs :attribute must be less than :value.',
        'file' => 'Le champs :attribute must be less than :value kilobytes.',
        'string' => 'Le champs :attribute must be less than :value characters.',
        'array' => 'Le champs :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'Le champs :attribute must be less than or equal to :value.',
        'file' => 'Le champs :attribute must be less than or equal to :value kilobytes.',
        'string' => 'Le champs :attribute must be less than or equal to :value characters.',
        'array' => 'Le champs :attribute must not have more than :value items.',
    ],
    'mac_address' => 'Le champs :attribute must be a valid MAC address.',
    'max' => [
        'numeric' => 'Le champs :attribute must not be greater than :max.',
        'file' => 'Le champs :attribute must not be greater than :max kilobytes.',
        'string' => 'Le champs :attribute must not be greater than :max characters.',
        'array' => 'Le champs :attribute must not have more than :max items.',
    ],
    'mimes' => 'Le champs :attribute must be a file of type: :values.',
    'mimetypes' => 'Le champs :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'Le champs :attribute doit être au moins :min.',
        'file' => 'Le champs :attribute must be at least :min kilobytes.',
        'string' => 'Le champs :attribute doit être au moins :min characters.',
        'array' => 'Le champs :attribute must have at least :min items.',
    ],
    'multiple_of' => 'Le champs :attribute must be a multiple of :value.',
    'not_in' => 'Le champs selected :attribute is invalid.',
    'not_regex' => 'Le champs :attribute format is invalid.',
    'numeric' => 'Le champs :attribute must be a number.',
    'password' => 'Le champs password is incorrect.',
    'present' => 'Le champs :attribute field must be present.',
    'prohibited' => 'Le champs :attribute field is prohibited.',
    'prohibited_if' => 'Le champs :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'Le champs :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'Le champs :attribute field prohibits :other from being present.',
    'regex' => 'Le format du champs :attribute est invalide.',
    'required' => 'Le champs :attribute  est requis.',
    'required_array_keys' => 'Le champs :attribute field must contain entries for: :values.',
    'required_if' => 'Le champs :attribute field is required when :other is :value.',
    'required_unless' => 'Le champs :attribute field is required unless :other is in :values.',
    'required_with' => 'Le champs :attribute field is required when :values is present.',
    'required_with_all' => 'Le champs :attribute field is required when :values are present.',
    'required_without' => 'Le champs :attribute field is required when :values is not present.',
    'required_without_all' => 'Le champs :attribute field is required when none of :values are present.',
    'same' => 'Le champs :attribute and :oLe champsr must match.',
    'size' => [
        'numeric' => 'Le champs :attribute must be :size.',
        'file' => 'Le champs :attribute must be :size kilobytes.',
        'string' => 'Le champs :attribute must be :size characters.',
        'array' => 'Le champs :attribute must contain :size items.',
    ],
    'starts_with' => 'Le champs :attribute must start with one of the following: :values.',
    'string' => 'Le champs :attribute must be a string.',
    'timezone' => 'Le champs :attribute must be a valid timezone.',
    'unique' => 'Le champs :attribute has already been taken.',
    'uploaded' => 'Le champs :attribute failed to upload.',
    'url' => 'Le champs :attribute must be a valid URL.',
    'uuid' => 'Le champs :attribute must be a valid UUID.',

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
        'skills.*.name' => [
            'required' => 'Les noms des compétences sont requises',
            'string' => 'Le nom des compétences doit être un mot'
        ],
        'skills.*.level' => [
            'required' => 'Les niveaux des compétences sont requises',
            'integer' => 'Les niveaux des compétences doit être un entier',
            'max' => 'Les niveaux ne peuvent pas dépasser 10',
            'min' => 'Les niveaux ne peuvent pas être moins de 1'
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
