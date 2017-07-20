<?php

namespace App\Models;
use Skvn\Crud\Models\CrudModel;

class Department extends CrudModel
{
    public $timestamps = false;

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

        if (!$this->use_masters) {
            $slots = Schedule::whereDepartmentId($this->id)
                ->select('week_day', 'time')
                    ->get()
                        ->groupBy('week_day')
                            ->toArray();
        }
        //FIXME add days off

        $dates = [];
        foreach ( $period as $dt ) {
            if (!empty($slots[$dt->format('w')])) {
                $dates[$dt->format("Y-m-d")] = array_column($slots[$dt->format('w')], 'time');
            }
        }

        // occupied
        $return = [];
        foreach ($dates as $vdate => $timeSlots) {
            //get appointments
            $apps = Appointment::where('visit_date', $vdate)
                    ->select('visit_time', \DB::raw('count(*) as total'))
                        ->groupBy('visit_time')
                            ->get()
                                ->keyBy('visit_time')
                                    ->toArray();

            $totalCap = $this->visit_capacity * count($timeSlots);
            $occupied = 0;
            foreach ($timeSlots as $slot) {
                $return[$vdate]['times'][$slot]['available'] = $this->visit_capacity;
                if (!empty($apps[$slot])) {
                    $return[$vdate]['times'][$slot]['occupied'] = $apps[$slot]['total'];
                    $occupied += $apps[$slot]['total'];
                } else {
                    $return[$vdate]['times'][$slot]['occupied'] = 0;
                }
            }
            $return[$vdate]['capacity'] = $totalCap;
            $return[$vdate]['occupied'] = $occupied;
        }

        return $return;
    }

}
