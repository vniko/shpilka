<?php

namespace App\Models;

use Skvn\Crud\Models\CrudModel;

class Client extends CrudModel
{
    protected $fillable = [
        'name',
        'dob',
        'lead_source',
        'phone',
        'comment',
        'email'
    ];

    public function getDobAttribute($value)
    {
        if (is_null($value)) {
            return null;
        }
        if ($value !== '0000-00-00') {
            return date('d.m.Y', strtotime($value));
        } else {
            return '';
        }
    }
}
