<?php

use Pratiksh\Adminetic\Models\Admin\Data;

if (! function_exists('business_hour_data')) {
    function business_hour_data($data = null)
    {
        return Data::firstOrCreate([
            'name' => 'business_hour',
        ], [
            'content' => config('business_hour.default', $data),
        ])->content;
    }
}

if (! function_exists('business_hour')) {
    function business_hour($data = null)
    {
        $data = $data ?? business_hour_data();
        $days = $data['days'] ?? null;
        $exceptions = $data['exceptions'] ?? null;
        $constructed_data = [];
        if (! is_null($days)) {
            foreach ($days as $day) {
                $intervals = [];
                if (count($day['intervals'] ?? []) > 0) {
                    foreach ($day['intervals'] as $interval) {
                        $start = $interval['start']['hour'].':'.$interval['start']['minute'];
                        $end = $interval['end']['hour'].':'.$interval['end']['minute'];
                        $intervals[] = $start.'-'.$end;
                    }
                    $constructed_data[$day['name']] = $intervals;
                }
            }
        }

        if (! is_null($exceptions)) {
            foreach ($exceptions as $exception) {
                $intervals = [];
                if (count($exception['intervals'] ?? []) > 0) {
                    foreach ($exception['intervals'] as $interval) {
                        $start = $interval['start']['hour'].':'.$interval['start']['minute'];
                        $end = $interval['end']['hour'].':'.$interval['end']['minute'];
                        $intervals[] = [
                            $start.'-'.$end,
                        ];
                    }
                }
                $constructed_data['exceptions'][$exception['date']] = $intervals;
            }
        }

        return $constructed_data;
    }
}
