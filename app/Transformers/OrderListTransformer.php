<?php

namespace App\Transformers;

use App\Models\Order;
use function foo\func;
use League\Fractal\TransformerAbstract;


class OrderListTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'client', 'lines'
    ];
    protected $defaultIncludes = ['lines'];

    public function transform(Order $order)
    {
        return [
            'id' => $order->id,
            'client' => $order->client->name,
            'date' => $order->created_at?$order->created_at->format('d.m.Y H:i'):'',
            'total' => $order->total,
            'is_deleted' => $order->deleted_at ? true : false,
            'payment_type_id' => $order->payment_type_id,
        ];

    }

    public function includeLines(Order $order)
    {
        return $this->collection($order->lines, function($line) {
            $arr =  $line->toArray();
            $arr['product'] = $line->product->toArray();
            $arr['category'] = $line->product->category->toArray();
            return $arr;
        });
    }
}
