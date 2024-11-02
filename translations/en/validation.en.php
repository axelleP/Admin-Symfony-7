<?php

declare(strict_types=1);

return [
    'not_blank' => 'This field is mandatory.',
    'positive' => 'The field must be a positive number.',
    'json' => 'The field must be a valid Json.',
    'email' => 'The field must be a valid email.',
    'decimal_max_2' => 'The field must be a number with a maximum of two decimal places.',
    'category' => [
        'code' => [
            'length' => 'The code must not exceed 30 characters.'
        ],
        'name' => [
            'length' => 'The name must not exceed 50 characters.'
        ]
    ],
    'article' => [
        'title_fr' => [
            'length' => 'The title must not exceed 50 characters.'
        ],
        'title_en' => [
            'length' => 'The title must not exceed 50 characters.'
        ],
        'image' => [
            'format' => 'Please upload a valid image (JPEG, PNG or GIF).'
        ]
    ],
    'user' => [
        'email' => [
            'length' => 'The email must not exceed 180 characters.'
        ],
        'password' => [
            'format' => 'The password must contain at least: 8 characters, an upper case letter, a lower case letter, a number and a special character.'
        ]
    ]
];
