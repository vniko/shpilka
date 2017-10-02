<?php

namespace App\Models;

use Carbon\Carbon;
use Skvn\Crud\Models\CrudModel;

class Schedule extends CrudModel
{

    public static function getForDepartment(Department $dep)
    {
        if (empty($dep->schedule_config)) {
         return Schedule::whereDepartmentId($dep->id)
                    ->select('week_day', 'time')
                        ->get()
                            ->groupBy('week_day')
                                ->toArray();
        } else {
            return self::createSlotsByConfig($dep->schedule_config);
        }
    }

    public static function createSlotsByConfig($config)
    {
        $config = json_decode($config, true);
        $days = [];
        switch ($config['week']) {
            case 'daily':
                for ($d=0; $d<=6; $d++) {
                    $days[] = $d;
                }
                break;
        }
        $hours = [];
        if (!empty($config['start_time']) && !empty($config['end_time'])) {
            $startDate = Carbon::parse($config['start_time']);
            $endDate = Carbon::parse($config['end_time']);
            $interval = new \DateInterval($config['interval']);
            while ($startDate < $endDate) {
                $hours[] = $startDate->format('H:i');
                $startDate->add($interval);
            }
        }
        $return = [];
        foreach ($days as $d) {
            foreach ($hours as $time) {
                $return[$d][] = ['week_day' => $d, 'time' => $time];
            }
        }

        return $return;

    }

}
