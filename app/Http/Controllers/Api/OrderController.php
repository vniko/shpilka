<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use App\Models\Category;
use App\Models\Client;
use App\Models\Department;
use App\Models\Master;
use App\Models\Order;
use App\Transformers\OrderListTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @apiDefine grpOrder Order
 * Working with orders
 *
 */
class OrderController extends Controller
{

    /**
     * Display a listing of the orders
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->get('filters');
        $orders = Order::filter($filters)
                        ->with('client')
                            ->get();
        return fractal($orders, new OrderListTransformer())->respond();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Order::createByData($request->all());
        if ($order && $order instanceof Order) {
            return response()->json(['data' => $order], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ['success' => Order::find($id)->delete()];

    }

}
