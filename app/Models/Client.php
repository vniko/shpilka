<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Skvn\Crud\Models\CrudModel;

class Client extends CrudModel
{
    use SoftDeletes, Filterable;

    public $timestamps = true;
    protected $fillable = [
        'name',
        'dob',
        'lead_source',
        'phone',
        'comment',
        'email',
        'kids',
        'adults',
        'kidsAfter7'

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

    /**
     * Create client model by data
     * @param $clientInfo
     * @return $this|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public static function createByData($clientInfo)
    {
        if (!empty($clientInfo['dob'])) {
            $clientInfo['dob'] = date('Y-m-d', strtotime($clientInfo['dob']));
        }

        if (!empty($clientInfo['id'])) {
            $client = self::find($clientInfo['id']);;
            $client->fill($clientInfo);
            $client->save();
        } else {
            $client = self::create($clientInfo);
        }

        return $client;
    }//


}
