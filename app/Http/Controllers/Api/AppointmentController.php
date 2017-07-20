<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Department;
use App\Models\Master;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @apiDefine grpAppointment Appointment
 * Working with appointments
 *
 */
class AppointmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->get('date')) {
            //get for a date
            return response()->json(
                [
                    'data' =>
                        [
                            'timeTable' => Appointment::getTimeTable($request->get('departmentId'), $request->get('date')),
                            'department' => Department::find($request->get('departmentId'))
                        ]
                ], 200);
        }
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
        if ($request->get('clientId')) {
            $client = Client::find($request->get('clientId'));
            $input = $request->all();
            if (!empty($input['dob'])) {
                $input['dob'] = date('Y-m-d', strtotime($input['dob']));
            }

            $client->fill($input);
            $client->save();
        } else {
            $input = $request->all();
            if (!empty($input['dob'])) {
                $input['dob'] = date('Y-m-d', strtotime($input['dob']));
            }
            $client = Client::create($input);
        }

        $app = new Appointment();
        $app->visit_date = $request->get('chosenDate');
        $app->visit_time = $request->get('chosenTime');
        $app->client_id = $client->id;
        $app->department_id = $request->get('departmentId');
        $app->master_id = $request->get('masterId');
        $app->comment = $request->get('visit_comment');
        $app->kids = $request->kids;
        $app->status = Appointment::STATUS_CREATED_OPERATOR;
        $app->save();

        return response()->json(['data' => $app], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $appt = Appointment::find($id);
        $appt->fill($request->all());
        if ($appt->save()) {

            return response()->json(
                [
                    'data' =>
                        [
                            'date' => $appt->visit_date,
                            'timeTable' => Appointment::getTimeTable($appt->department_id, $appt->visit_date),
                            'department' => Department::find($appt->department_id)
                        ]
                ], 200);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appt = Appointment::find($id);
        return response()->json(
        [
            'success' => $appt->delete()
        ], 200);
    }

}
