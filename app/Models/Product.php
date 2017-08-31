<?php

namespace App\Models;

use Skvn\Crud\Models\CrudModel;

class Product extends CrudModel
{
    protected $fillable = [
        'name',
    ];

    
}
