<?php
namespace App\Http\Controllers\Api;

use App\Models\Client;
use App\Models\Department;
use App\Models\Master;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @apiDefine grpClient Client
 * Working with Client entity
 *
 */

class ClientController extends Controller
{

    /**
     * @api {get} /clients/search/?q=:query GetSearchClients
     * @apiName GetSearchClients
     * @apiGroup grpClient
     *
     * @apiDescription Search clients
     *
     * @apiParam {String} query Search query
     *
     * @apiParamExample {json} Sample request:
     * {
     *       "query": "ваня",
     * }
     * @apiSuccess {Array} data Clients list
     *
     * @apiSuccessExample {json} Sample response:
     * {
     *     []
     * }
     */
    public function search(Request $request) {
        $query = $request->get('q');
        if (!empty($query)) {
            $clients = Client::where('name', 'like', '%'.$query.'%')
                    ->orWhere('phone', 'like',  '%'.$query.'%')
                        ->get();
            return response()->json($clients, 200);
        }

    }
}
