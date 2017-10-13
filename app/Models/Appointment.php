<?php

namespace App\Models;

use Skvn\Crud\Models\CrudModel;

class Appointment extends CrudModel
{

    const STATUS_CREATED_OPERATOR = 0;
    const STATUS_FINISHED_OK = 1;
    const STATUS_FINISHED_FAIL = 2;

    public $timestamps = true;
    protected $guarded = ['id', 'status'];

    public static function getForDate($date, $departmentId)
    {
        return self::with('client')->whereVisitDate($date)
            ->whereDepartmentId($departmentId)
                ->orderBy('visit_time')
                    ->get();
    }

    public static function getTimeTable($depId, $visitDate)
    {
        $apps = self::getForDate(
            $visitDate,
            $depId);
        $occupied = $apps->groupBy('visit_time')->toArray();
        $department = Department::find($depId);
        $weekday = date('w', strtotime($visitDate));
        $slots = Schedule::getForDepartment($department)[$weekday];
        $ret = [];
        foreach ($slots as $slot) {
            if (!empty($occupied[$slot['time']])) {
                $ret[$slot['time']] = $occupied[$slot['time']];
            } else {
                $ret[$slot['time']] = [];
            }
        }
        return $ret;
    }

}
