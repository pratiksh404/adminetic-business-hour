<?php

namespace Adminetic\BusinessHour\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use Pratiksh\Adminetic\Models\Admin\Data;

class BusinessHourExceptions extends Component
{
    public $data;
    public $business_hour;
    public $exceptions;
    public $exception_toggle = false;

    // Attribute
    public $date;

    protected $listeners = ['initialize_business_hour_exceptions' => 'initializeBusinessHourExceptions'];

    protected $rules = [
        'exceptions.*.date' => 'required|date|date_format:Y-m-d',
        'exceptions.*.intervals.*.start.hour' => 'required|numeric|max:23',
        'exceptions.*.intervals.*.start.minute' => 'required|numeric|max:60',
        'exceptions.*.intervals.*.end.hour' => 'required|numeric|max:23',
        'exceptions.*.intervals.*.end.minute' => 'required|numeric|max:60',
    ];

    protected $messages = [
        'exceptions.*.intervals.*.start.hour.required' => 'Hour must be numeric',
        'exceptions.*.intervals.*.start.minute.required' => 'Minute must be numeric',
        'exceptions.*.intervals.*.end.hour.required' => 'Hour must be numeric',
        'exceptions.*.intervals.*.end.minute.required' => 'Minute must be numeric',
        'exceptions.*.intervals.*.start.hour.max' => 'Hour must be max upto 23',
        'exceptions.*.intervals.*.start.minute.max' => 'Minute must be max upto 60',
        'exceptions.*.intervals.*.end.hour.max' => 'Hour must be max upto 23',
        'exceptions.*.intervals.*.end.minute.max' => 'Minute must be max upto 60',
    ];

    public function mount()
    {
        $this->data = Data::firstOrCreate([
            'name' => 'business_hour',
        ], [
            'content' => config('business_hour.default', null),
        ]);
        $this->business_hour = $this->data->content ?? config('business_hour.default', null);
        $this->exceptions = $this->business_hour['exceptions'] ?? null;
    }

    public function initializeBusinessHourExceptions()
    {
        $this->emit('initializeBusinessHourExceptions');
    }

    public function add_exception()
    {
        $this->exceptions[] = [
            'date' => Carbon::now()->format('Y-m-d'),
            'open' => true,
            'intervals' => [
                [
                    'start' => [
                        'hour' => '09',
                        'minute' => '00',
                    ],
                    'end' => [
                        'hour' => '17',
                        'minute' => '00',
                    ],
                ],
            ],
        ];
        $this->emit('business_hour_exceptions_success', 'Exception added.');
    }

    public function remove_exception($day)
    {
        $exceptions = $this->exceptions;
        unset($exceptions[$day]);
        $this->exceptions = $exceptions;
        $this->emit('business_hour_exceptions_danger', 'Exception removed.');
    }

    public function add_exception_date_interval($day)
    {
        $this->exceptions[$day]['intervals'][] = [
            'start' => [
                'hour' => '09',
                'minute' => '00',
            ],
            'end' => [
                'hour' => '17',
                'minute' => '00',
            ],
        ];
        $this->emit('business_hour_exceptions_success', 'Interval for exception added.');
    }

    public function remove_exception_date_interval($day, $index)
    {
        $exceptions = $this->exceptions;
        unset($exceptions[$day]['intervals'][$index]);
        $this->exceptions = $exceptions;
        $this->emit('business_hour_exceptions_danger', 'Interval for exception removed.');
    }

    public function save()
    {
        $this->validate();
        $content = $this->data->content;
        $content['exceptions'] = $this->exceptions;
        $this->data->update([
            'content' => $content,
        ]);
        $this->emit('business_hour_exceptions_success', 'Exceptions saved.');
    }

    public function render()
    {
        return view('business_hour::livewire.admin.business-hour-exceptions');
    }
}
