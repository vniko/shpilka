<?php

namespace App\Models;

use Skvn\Crud\Models\CrudModel;

class Master extends CrudModel
{
    public function getAvailableDates($date = null) {
        if (is_null($date)) {
            $date = date('Y-m-d',time());
        }
        $dateStart = new \DateTime($date);
        $dateStart->modify('first day of this month');

        $dateEnd = new \DateTime($date);
        $dateEnd->modify('first day of next month');

        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($dateStart, $interval, $dateEnd);

        $slots = Schedule::whereMasterId($this->id)
                ->select('week_day','time')
                    ->get()
                        ->groupBy('week_day')
                            ->toArray();

        //FIXME add days off

        $dates = [];
        foreach ( $period as $dt ) {
            if (!empty($slots[$dt->format('w')])) {
                $dates[$dt->format("Y-m-d")] = array_column($slots[$dt->format('w')], 'time');
            }
        }

        //FIXME remove occupied
        foreach ($dates as $vdate => $timeSlots) {
            //get appointments
            $apps = Appointment::where('visit_date', $vdate)
                    ->select('visit_time')
                        ->pluck('visit_time')
                            ->all();
            if (count($apps)) {
                foreach ($timeSlots as $k=> $slot) {
                    if (in_array($slot, $apps)) {
                        unset($dates[$vdate][$k]);
                    }
                    if (!count($dates[$vdate])) {
                        unset ($dates[$vdate]);
                    }
                }
            }
        }

        return $dates;


    }
}
