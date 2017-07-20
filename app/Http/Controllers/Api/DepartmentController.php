<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use App\Models\Department;
use App\Models\Master;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @apiDefine grpDepartment Department
 * Working with department entity
 *
 */
class DepartmentController extends Controller
{
    public function index()
    {
        return Department::with('masters')->get();
    }

    /**
     * @api {get} /departments/dates/:id/:date GetDepartmentDates
     * @apiName GetDepartmentDates
     * @apiGroup grpDepartment
     *
     * @apiDescription Get department's available time slots grouped by dates and department info
     *
     * @apiParam {Number} id Department's ID
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
     *   "data":
     *      {
     *          "dates":
     *              {
     *                  "2017-07-02":{"08:00":{"available":6},"09:00":{"available":6}},...
     *              },
     *           "department":{
     *                  "id":1,
     *                  "title": "\u041f\u0435\u0449\u0435\u0440\u0430",
     *                  "visit_capacity":6,
     *                  "use_masters":0,
     *                  "masters":[]
     *          }
     *    }
     * }
     */
    public function availableDates($id)
    {
        $dep = Department::with('masters')->find($id);
        return response()->json([
            'data' =>
                [
                    'dates' => $dep->getAvailableDates(),
                    'department' => $dep
                ]
        ], 200);
    }



}
