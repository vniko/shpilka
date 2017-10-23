<?php
namespace App\Http\Controllers\Api;

use App\Models\Client;
use App\Models\Department;
use App\Models\Master;
use App\Transformers\ClientTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

/**
 * @apiDefine grpClient Client
 * Working with Client entity
 *
 */

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $filters = $request->get('filters');

        $clientsPaginator = Client::filter($filters)
                                ->orderBy('name')
                                    ->paginate(50);
        return fractal()
                ->collection($clientsPaginator->getCollection())
                    ->transformWith(new ClientTransformer())
                        ->paginateWith(new IlluminatePaginatorAdapter($clientsPaginator))
                            ->respond();
    }

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
            if (mb_strlen($query, 'UTF-8')>3) {
                $query = mb_substr($query,1, null, 'UTF-8');
            }
            $clients = Client::where('name', 'like', '%'.$query.'%')
                    ->orWhere('phone', 'like',  '%'.$query.'%')
                        ->get();
            return response()->json($clients, 200);
        }

    }

    public function update(Request $request)
    {
        $client = Client::find($request->get('id'));
        $client->fill($request->all());
        $client->save();
        return $client;
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        return response()->json(
            [
                'success' => $client->delete()
            ], 200);
    }
}
