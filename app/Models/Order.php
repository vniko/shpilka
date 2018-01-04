<?php

namespace App\Models;

use App\Traits\Filterable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Skvn\Crud\Models\CrudModel;

class Order extends CrudModel
{
    use SoftDeletes, Filterable;

    const NO_CLIENT = -1;

    const PMT_TYPE_CASH = 0;
    const PMT_TYPE_CARD = 1;

    public $timestamps  = true;
    protected $guarded = [
        'id',
        'seller_id',
    ];


    public static function createByData($payload)
    {
        $order = new Order();
        $order->total = $payload['total'];
        $order->total_discount = $payload['total_discount'];
        $order->payment_type_id = $payload['payment_type_id'];
        if (!empty($payload['clientInfo']['id']) && (int)$payload['clientInfo']['id'] === self::NO_CLIENT) {
            $order->client_id = self::NO_CLIENT;
        } else {
            $client = Client::createByData($payload['clientInfo']);
            $order->client_id = $client->id;
        }
        $order->seller_id = \Auth::user()->id;
        if ($order->save()) {
            foreach ($payload['lines'] as $line) {
                $line['product_id'] = $line['product']['id'];
                $line['total_discount'] = $line['price']/100*$line['discount_perc'];
                unset($line['product']);
                $line['order_id'] = $order->id;
                $lineObj = OrderLine::create($line);
                $lineObj->save();
            }
        }

        return $order;
    }

    public function scopeFilterByDate($query, $date)
    {
        if (!empty($date)) {
            $query->whereDate('created_at', Carbon::parse($date));
        }
        return $query;

    }

    public function scopeFilterByStartDate($query, $date)
    {
        if (!empty($date)) {
            $query->whereDate('created_at', '>=', Carbon::parse($date));
        }
        return $query;

    }

    public function scopeFilterByEndDate($query, $date)
    {
        if (!empty($date)) {
            $query->whereDate('created_at', '<=', Carbon::parse($date));
        }
        return $query;

    }
}
