<?php 
 return [
    "name" => "Order",
    "title_field" => "",
    "ent_name" => "order",

    "scopes" => [
        "default" => [
            "title" => "",
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
            "title" => "клиент",
            "model" => "client",
        ],
    ]
];