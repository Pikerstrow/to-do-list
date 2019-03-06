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
    'required' => 'Поле :attribute обов\'язкове до заповнення.',
    'min' => [
        'string' => 'Поле :attribute не може містити менше ніж :min символів.',
    ],
    'max' => [
        'string' => 'Поле :attribute не може містити більше ніж :min символів.',
    ],
    'date' => 'Значення поля :attribute не являється датою.',
    'date_format' => 'Значення поля :attribute не відповідає необхідному формату - :format.',
    'after_or_equal' => 'Значення поля :attribute повинне бути датою після або рівною :date.',
    'integer' => 'Поле :attribute приймає лише цілі числа.',
    'between' => [
        'numeric' => 'Значення :attribute поля може бути лише цілим числом від :min до :max.',
    ],

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

    'attributes' => [
        'title' => 'Навза завдання',
        'description' => 'Опис завдання',
        'due_date'=> 'Планова дата виконання завдання',
        'status' => 'Статус завдання'
    ],

];
