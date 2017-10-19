<?php

namespace App\Transformers;

use App\Models\Client;
use League\Fractal\TransformerAbstract;


class ClientTransformer extends TransformerAbstract
{


    public function transform(Client $client)
    {
        $clientArr = $client->toArray();
        return $clientArr;

    }
}
