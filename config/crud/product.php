<?php 
 return [
    "name" => "Product",
    "title_field" => "name",
    "ent_name" => "product",

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
        "category" => [
            "relation" => "belongsTo",
            "field" => "category_id",
            "title" => "Категория",
            "model" => "category",
            "editable" => 1,
            "type" => "select"
        ],
    ]
];