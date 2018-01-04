<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Skvn\Crud\Models\CrudModel;

class Category extends CrudModel
{

    use SoftDeletes;

    protected $fillable = [
        'name',
        'icon_class',
        'block_class',
    ];

    public $timestamps = false;
}
