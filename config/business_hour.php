<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Week Business Time
    |--------------------------------------------------------------------------
    |
    */
    'default' => [
        'days' => [
            [
                'name' =>  'sunday',
                'open' => false,
                'intervals' => [],
            ],
            [
                'name' =>  'monday',
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
                'data' => null,
            ],
            [
                'name' =>  'tuesday',
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
                'data' => null,
            ],
            [
                'name' =>  'wednesday',
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
                'data' => null,
            ],
            [
                'name' =>  'thursday',
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
                'data' => null,
            ],
            [
                'name' =>  'friday',
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
                'data' => null,
            ],
            [
                'name' =>  'saturday',
                'open' => false,
                'intervals' => [],
            ],
        ],
    ],
];
