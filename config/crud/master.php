<?php
return [
    "name" => "Master",
    "title_field" => "name",
    "ent_name" => "master",

    "scopes" => [
        "default" => [
            "title" => "Masters",
            "description" => "",
            "multiselect" => "1",
            "edit_tab" => "1",
            "buttons" => [
                "add_new" => "1",
                "single_edit" => "1",
                "single_delete" => "1",
                "mass_delete" => "1",
                "customize_columns" => "0"
            ],
            "list" => [],
            "searchable" => 1,
            "form" => "default",
        ]
    ],
    "forms" => [
        "default" => [
            "name",
        ]
    ],
    "fields" => [
        "name" => [
            "type" => "text",
            "title" => "Name",
            "hint_default" => "",
            "required" => "1",
            "editable" => 1
        ],
        "department" => [
            "relation" => "belongsTo",
            "title" => "Отдел",
            "model" => "department",
            "editable" => 1,
            "type" => "select"
        ]

    ]
];