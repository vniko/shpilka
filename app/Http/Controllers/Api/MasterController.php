<?php
namespace App\Http\Controllers\Api;

use App\Models\Department;
use App\Models\Master;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @apiDefine grpMaster Master
 * Working with Master entity
 *
 */

class MasterController extends Controller
{

    /**
     * @api {get} /masters/dates/:id/:date GetMasterDates
     * @apiName GetMasterDates
     * @apiGroup grpMaster
     *
     * @apiDescription Get master's available time slots grouped by dates
     *
     * @apiParam {Number} id Master's ID
     * @apiParam {String} [date] Date for month to use, if no date provided, current month is used
     *
     * @apiParamExample {json} Sample request:
     * {
     *       "id": "1",
     *       "date": "2017-01-01",
     * }
     * @apiSuccess {Object} data Object with dates as keys and time slot arrays as values
     *
     * @apiSuccessExample {json} Sample response:
     * {
     *    "data": {
     *       "2017-07-02":["08:00","09:00"],
     *       "2017-07-07":["09:00","09:45"]
     *    }
     * }
     */
    public function availableDates($id) {
        $master = Master::find($id);
        return response()->json(['data' => $master->getAvailableDates()], 200);
    }
}
