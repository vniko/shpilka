<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use App\Models\Category;
use App\Models\Client;
use App\Models\Department;
use App\Models\Master;
use App\Models\Order;
use App\Models\User;
use App\Models\Worklog;
use App\Transformers\OrderListTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @apiDefine grpWorklog Worklog
 * Working with worklogs
 *
 */
class WorklogController extends Controller
{

    /**
     * Display a listing of the worklogs
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $user_id = $request->get('user_id');

        $logs = Worklog::with(['user']);
        if ($start_date) {
            $logs->whereDate('work_date', '>=', $start_date);
        }
        if ($end_date) {
            $logs->whereDate('work_date', '<=', $end_date);
        }
        if ($user_id) {
            $logs->where('user_id', $user_id);
        }

        $logs = $logs->orderBy('work_date')->get();
        $users = User::all();
        $users = fractal($users, function($user) {
           return ['id' => $user->id, 'name' => $user->name];
        });
        return fractal($logs, function($log) {
                $arr = $log->toArray();
                $arr['work_date'] = date('d.m.Y', strtotime($arr['work_date']));
                $arr['user'] = $log->user->toArray();
                return $arr;
                })
                ->addMeta(['users' => $users])
                    ->respond();

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $worklog = Worklog::firstOrNew(['work_date' => $request->get('work_date')]);
        $worklog->fill($request->all());
        if ($worklog->save()) {
            return response()->json(['data' => $worklog], 200);
        } else {
            return response()->json(['error' => 'Ошибка'], 413);
        }
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
        return ['success' => Worklog::find($id)->delete()];

    }

}
