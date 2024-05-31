<?php

namespace App\Repositories;

use Carbon\Carbon;

class DayRepository extends Repository
{
    public function getAll(): array|false
    {
        $dates = [];

        $today = Carbon::now();
        for ($i = 1; $i <= 7; $i++) {
            $dates[] = $this->calculateDayArray($today);
            $today->addDay();
        }
        return $dates;
    }

    private function calculateDayArray($today)
    {
        return ['date' => $today->format("Y-m-d"), 'day' => $today->dayOfWeek];
    }

}