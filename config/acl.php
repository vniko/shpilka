<?php
return [
    'acls' => [
        'all' => "Полный доступ",
        'some_ability' => "Какое-то разпешение",
    ],
    'roles' => [
        'root' => [
            'title' => "Root",
            'acls' => [
                'all' => '*'
            ]
        ],
        'admin' => [
            'title' => "Админ",
            'acls' => [
                'all' => "*",
            ]
        ],
    ]
];
