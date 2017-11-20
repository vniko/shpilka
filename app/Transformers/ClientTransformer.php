<?php

namespace App\Transformers;

use App\Models\Client;
use League\Fractal\TransformerAbstract;


class ClientTransformer extends TransformerAbstract
{


    public function transform(Client $client)
    {
        $clientArr = $client->toArray();
        $clientArr['created_at']  = $client->created_at ? $client->created_at->format('d.m.Y'): 'н/д';
        $clientArr['num_apps'] = $client->appointments()->count();
        $clientArr['num_orders'] = $client->orders()->count();
        return $clientArr;

    }
}
