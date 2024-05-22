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

    'accepted' => 'L\'attribut: doit être accepté.',
    'active_url' => 'L\'attribut: n\'est pas une URL valide.',
    'after' => 'L\'attribut: doit être une date après: date.',
    'after_or_equal' => 'L\'attribut: doit être une date postérieure ou égale à: date.',
    'alpha' => 'L\'attribut: ne peut contenir que des lettres.',
    'alpha_dash' => 'L\'attribut: ne peut contenir que des lettres, des chiffres, des tirets et des traits de soulignement.',
    'alpha_num' => 'L\'attribut: ne peut contenir que des lettres et des chiffres.',
    'array' => 'L\'attribut: doit être un tableau.',
    'before' => 'L\'attribut: doit être une date antérieure à: date.',
    'before_or_equal' => 'L\'attribut: doit être une date antérieure ou égale à: date.',
    'between' => [
        'numeric' => 'L \' attribut: doit être compris entre: min et: max. ',
        'file' => 'L \' attribut: doit être compris entre: min et: max kilo-octets. ',
        'string' => 'L\'attribut: doit être compris entre: min et: max caractères.',
        'array' => 'L\'attribut: doit avoir entre: min et: max items.',
    ],
    'boolean' => 'Le champ: attribut doit être vrai ou faux.',
    'confirmed' => 'La confirmation de l\’attribut: ne correspond pas.',
    'date' => 'L\'attribut: n\'est pas une date valide.',
    'date_equals' => 'L\'attribut: doit être une date égale à: date.',
    'date_format' => 'L\'attribut: ne correspond pas au format: format.',
    'different' => 'Les attributs: and: other doivent être différents.',
    'digits' => 'L \': attribut doit être: chiffres chiffres. ',
    'digits_between' => 'L’attribut: doit être compris entre: min et: max digits.',
    'dimensions' => 'L \' attribut: a des dimensions d \'image non valides.',
    'distinct' => 'Le champ: attribute a une valeur en double.',
    'email' => 'L \' attribut: doit être une adresse e-mail valide. ',
    'ends_with' => 'L \' attribut: doit se terminer par l \'un des éléments suivants:: valeurs.',
    'exists' => 'L \' attribut sélectionné: n \'est pas valide.',
   'file' => 'L \' attribut doit être un fichier. ',
    'filled' => 'Le champ: attribute doit avoir une valeur.',
    'gt' => [
        'numeric' => 'L\'attribut doit être supérieur à: valeur. ',
        'file' => 'L\'attribut doit être supérieur à: valeur kilo-octets. ',
        'string' => 'L\'attribut doit être supérieur à: valeur caractères. ',
        'array' => 'L\'attribut doit avoir plus de: éléments de valeur. ',
    ],
'gte' => [
        'numeric' => 'L \': attribut doit être supérieur ou égal à: valeur. ',
        'file' => 'L \': attribut doit être supérieur ou égal à: value kilo-octets. ',
        'string' => 'L \' attribut: doit être supérieur ou égal à: valeur caractères. ',
        'array' => 'L \': attribut doit avoir: éléments de valeur ou plus. ',
    ],
     'image' => 'L \': attribut doit être une image. ',
    'in' => 'L \' attribut sélectionné: n \'est pas valide.',
    'in_array' => 'Le champ: attribute n\'existe pas dans: other.',
    'integer' => 'L \': attribut doit être un entier. ',
    'ip' => 'L \': attribut doit être une adresse IP valide. ',
    'ipv4' => 'L \': attribut doit être une adresse IPv4 valide. ',
    'ipv6' => 'L \': attribut doit être une adresse IPv6 valide. ',
     'json' => 'L \' attribut: doit être une chaîne JSON valide. ',
    'lt' => [
        'numeric' => 'L \': attribut doit être inférieur à: valeur. ',
        'file' => 'L \': attribut doit être inférieur à: valeur kilo-octets. ',
        'string' => 'L \': attribut doit être inférieur à: caractères de valeur. ',
        'array' => 'L \': attribut doit avoir moins de: éléments de valeur. ',
    ],
    'lte' => [
        'numeric' => 'L \': attribut doit être inférieur ou égal à: valeur. ',
        'file' => 'L \': attribut doit être inférieur ou égal à: valeur kilo-octets. ',
        'string' => 'L \' attribut: doit être inférieur ou égal à: valeur caractères. ',
        'array' => 'L \': attribut ne doit pas avoir plus de: éléments de valeur. ',
    ],
    'max' => [
        'numeric' => 'L \': attribut ne doit pas être supérieur à: max. ',
        'file' => 'L \': attribut ne doit pas être supérieur à: max kilo-octets. ',
        'string' => 'L \': attribut ne peut pas être supérieur à: max caractères. ',
        'array' => 'L \': attribut ne peut pas avoir plus de: max éléments. ',
    ],
    'mimes' => 'L \' attribut: doit être un fichier de type:: values. ',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'L \': attribut doit être au moins: min. ',
        'file' => 'L \': attribut doit être au moins: min kilo-octets. ',
        'string' => 'L \': attribut doit contenir au moins: min caractères. ',
        'array' => 'L \': attribut doit avoir au moins: min items. ',
    ],
    'not_in' => 'L\'attribut selected: n\'est pas valide.',
    'not_regex' => 'Le: format d\'attribut n\'est pas valide.',
    'numeric' => 'L\'attribut: doit être un nombre.',
    'password' => 'Le mot de passe est incorrect.',
    'present' => 'Le champ: attribute doit être présent.',
    'regex' => 'Le: format de l \' attribut n \'est pas valide.',
     'required' => 'Le champ  :attribute est obligatoire.',
    'required_if' => 'Le champ: attribute est requis lorsque: other est: value.',
    'required_unless' => 'Le champ: attribute est obligatoire sauf si: other est dans: values.',
     'required_with' => 'Le champ: attribute est obligatoire lorsque: values nest présent.',
    'required_with_all' => 'Le champ: attribute est requis lorsque: des valeurs sont présentes.',
     'required_without' => 'Le champ: attribute est requis lorsque: values n \' est pas présent. ',
     'required_without_all' => 'Le champ: attribute est requis quand aucune des valeurs: n\'est présente.',
    'same' => 'Les attributs: et: other doivent correspondre.',
    'size' => [
            'numeric' => 'L \': attribut doit être: taille. ',
            'file' => 'L \': attribut doit être: taille kilo-octets. ',
            'string' => 'L \': attribut doit être: caractères de taille. ',
            'array' => 'L \': attribut doit contenir: éléments de taille. ',
        ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'starts_with' => 'L\' attribut: doit commencer par l\'un des éléments suivants: : valeurs.',
    'string' => 'L\'attribut: doit être une chaîne.',
    'timezone' => 'L\'attribut: doit être une zone valide.',
    'unique' => 'L\'attribut: a déjà été pris.',
    'uploaded' => 'L\'attribut: n\'a pas pu être téléchargé.',
    'url' => 'Le format de l\'attribut: n\'est pas valide.',
    'uuid' => 'L\'attribut: doit être un UUID valide.',

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

