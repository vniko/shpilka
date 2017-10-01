<?php

namespace App\Transformers;

use App\Models\Order;
use League\Fractal\TransformerAbstract;


class OrderListTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'client',
    ];

    public function transform(Order $order)
    {
        return [
            'id' => $order->id,
            'client' => $order->client->name,
            'date' => $order->created_at?$order->created_at->format('d.m.Y H:i'):'',
            'total' => $order->total,
            'is_deleted' => $order->deleted_at ? true : false,
        ];

    }
}
