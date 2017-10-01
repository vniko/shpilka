<?php

namespace App\Models;

use Skvn\Crud\Models\CrudModel;

class Abonement extends CrudModel
{
    protected $guarded = [
        'id',
    ];

    public $timestamps = true;


}
