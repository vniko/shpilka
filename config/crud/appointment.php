<?php 
 return [
    "name" => "Appointment",
    "title_field" => "",
    "ent_name" => "",

    "scopes" => [
        "default" => [
            "title" => "Deps",
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
            "list_actions" => [],
            "searchable" => 1,
            "form" => "default",
        ]
    ],
    "forms" => [
        "default" => [

            ]
    ],
    "fields" => [
        "client" => [
            "relation" => "belongsTo",
            "field" => "client_id",
            "title" => "Клиент",
            "model" => "client",
            "editable" => 1,
            "type" => "select"
        ],
        "department" => [
            "relation" => "belongsTo",
            "field" => "department_id",
            "title" => "Отделение",
            "model" => "department",
            "editable" => 1,
            "type" => "select"
        ]

    ]
];