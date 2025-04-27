<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function events()
    {
        $events = [
            [
                'id' => 1,
                'title' => 'Installation at Client A',
                'start' => '2025-04-28',
                'color' => '#22c55e' // green
            ],
            [
                'id' => 2,
                'title' => 'Reminder: Maintenance for Client B',
                'start' => '2025-04-30',
                'color' => '#facc15' // yellow
            ],
            [
                'id' => 3,
                'title' => 'Software Update - Client C',
                'start' => '2025-05-02',
                'color' => '#3b82f6' // blue
            ]
        ];

        return response()->json($events);
    }
}
