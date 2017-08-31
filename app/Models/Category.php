<?php

namespace App\Models;

use Skvn\Crud\Models\CrudModel;

class Category extends CrudModel
{
    protected $fillable = [
        'name',
        'icon_class',
        'block_class',
    ];

    public $timestamps = false;
}
