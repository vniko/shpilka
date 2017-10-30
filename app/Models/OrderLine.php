<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Skvn\Crud\Models\CrudModel;

class OrderLine extends CrudModel
{
    use SoftDeletes;

    protected $guarded = [
        'id',
    ];

    public function onAfterCreate()
    {
        if ($this->product->is_abonement) {
            Abonement::create([
                'order_line_id' => $this->id,
                'product_id' => $this->product->id,
                'client_id' => $this->order->client_id,
                'order_id' => $this->order_id,
                'visits' => $this->product->abonement_visits,
                'visits_left' => $this->product->abonement_visits,
                'valid_from' => time(),
                'valid_to' => $this->product->abonement_days > 0 ? strtotime('+ ' . $this->product->abonement_days . ' days') : strtotime('+5 years'),
            ]);
        }
    }
}
