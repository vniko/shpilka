<?php

return [
    'model_namespace' => '\App\Models',
    'history_trait' => '\Skvn\Crud\Traits\ModelHistoryTrait',
    'tree_trait' => '\Skvn\Crud\Traits\ModelTreeTrait',
    'collection_class' => \Skvn\Crud\Models\CrudCollection :: class,
    'app_title' => env('APPLICATION_TITLE', 'Shpilka CRM'),
    'auto_migrate_allowed' => env('AUTO_MIGRATE_ENABLED', true),
    'app_logo' => env('APPLICATION_LOGO', null),
    'replace_morph_classes_with_basename' => true,
    'assets' => [
        'js' => [
        ],
        'css' => [

        ],
    ],
    'form_controls' => [
        Skvn\Crud\Form\Checkbox :: class,
        Skvn\Crud\Form\Date :: class,
        Skvn\Crud\Form\DateRange :: class,
        Skvn\Crud\Form\DateTime :: class,
        Skvn\Crud\Form\File :: class,
        Skvn\Crud\Form\Image :: class,
        Skvn\Crud\Form\MultiFile :: class,
        Skvn\Crud\Form\Number :: class,
        Skvn\Crud\Form\Range :: class,
        Skvn\Crud\Form\Select :: class,
        Skvn\Crud\Form\Radio :: class,
        Skvn\Crud\Form\Tags :: class,
        Skvn\Crud\Form\Textarea :: class,
        Skvn\Crud\Form\Text :: class,
        Skvn\Crud\Form\Tree :: class,
        Skvn\Crud\Form\EntitySelect :: class,


    ],

    'relations' => [
        'hasOne' => Skvn\Crud\Models\RelationHasOne :: class,
        'hasFile' => Skvn\Crud\Models\RelationHasFile :: class,
        'hasMany' => Skvn\Crud\Models\RelationHasMany :: class,
        'hasManyFiles' => Skvn\Crud\Models\RelationHasManyFiles :: class,
        'belongsTo' => Skvn\Crud\Models\RelationBelongsTo :: class,
        'belongsToMany' => Skvn\Crud\Models\RelationBelongsToMany :: class,
        'morphTo' => Skvn\Crud\Models\RelationMorphTo :: class,
        'morphMany' => Skvn\Crud\Models\RelationMorphMany :: class,
    ]

];

