<?php 
 return [
    "name" => "Department",
    "title_field" => "title",
    "ent_name" => "dep",

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
            "title",

            ]
    ],
    "fields" => [
        "title" => [
            "type" => "text",
            "title" => "Title",
            "hint_default" => "",
            "required" => "1",
            "editable" => 1
        ],
//        "small_image" => [
//            "field" => "small_image_id",
//            "relation" => "hasFile",
//            "model" => "file",
//            "type" => "image",
//            "title" => "Изображение мелкое",
//            "on_delete" => "delete"
//        ],

        "masters" => [
            "relation" => "hasMany",
            "field" => "department_id",
            "title" => "Мастера",
            "model" => "master",
            "editable" => 1,
            "type" => "select"
        ]

    ]
];