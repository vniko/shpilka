<?php 
 return [
    "name" => "Worklog",
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
        "user" => [
            "relation" => "belongsTo",
            "field" => "user_id",
            "title" => "User",
            "model" => "user",
        ],

    ]
];