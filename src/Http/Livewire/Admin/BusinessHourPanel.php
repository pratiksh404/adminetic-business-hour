<?php

namespace Adminetic\BusinessHour\Http\Livewire\Admin;

use Livewire\Component;
use Pratiksh\Adminetic\Models\Admin\Data;

class BusinessHourPanel extends Component
{
    public $data;

    public $business_hour;
    public $days;

    protected $rules = [
        'days.*.intervals.*.start.hour' => 'required|numeric|max:23',
        'days.*.intervals.*.start.minute' => 'required|numeric|max:60',
        'days.*.intervals.*.end.hour' => 'required|numeric|max:23',
        'days.*.intervals.*.end.minute' => 'required|numeric|max:60',
    ];

    protected $messages = [
        'days.*.intervals.*.start.hour.required' => 'Hour must be numeric',
        'days.*.intervals.*.start.minute.required' => 'Minute must be numeric',
        'days.*.intervals.*.end.hour.required' => 'Hour must be numeric',
        'days.*.intervals.*.end.minute.required' => 'Minute must be numeric',
        'days.*.intervals.*.start.hour.max' => 'Hour must be max upto 23',
        'days.*.intervals.*.start.minute.max' => 'Minute must be max upto 60',
        'days.*.intervals.*.end.hour.max' => 'Hour must be max upto 23',
        'days.*.intervals.*.end.minute.max' => 'Minute must be max upto 60',
    ];

    public function mount()
    {
        $this->data = Data::firstOrCreate([
            'name' => 'business_hour',
        ], [
            'content' => config('business_hour.default', null),
        ]);
        $this->business_hour = $this->data->content ?? config('business_hour.default', null);
        $this->days = $this->business_hour['days'] ?? null;
    }

    public function add_interval($day)
    {
        $this->days[$day]['intervals'][] = [
            'start' => [
                'hour' => '09',
                'minute' => '00',
            ],
            'end' => [
                'hour' => '17',
                'minute' => '00',
            ],
        ];
        $this->emit('business_hour_panel_success', 'Interval added for '.strtoupper($this->days[$day]['name']));
    }

    public function remove_interval($day, $index)
    {
        $days = $this->days;
        unset($days[$day]['intervals'][$index]);
        $this->days = $days;
        $this->emit('business_hour_panel_danger', 'Interval removed for '.strtoupper($this->days[$day]['name']));
    }

    public function save()
    {
        $this->validate();
        $content = $this->data->content;
        $content['days'] = $this->days;
        $this->data->update([
            'content' => $content,
        ]);
        $this->emit('business_hour_panel_success', 'Business hour saved successfully');
    }

    public function render()
    {
        return view('business_hour::livewire.admin.business-hour-panel');
    }
}
