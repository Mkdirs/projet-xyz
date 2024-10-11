<?php

namespace App\Http\Controllers;

use App\Models\Track;
use App\Models\Week;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index(Request $request, Week $week, Track $track){

        return view('app.tracks.show', [
            'track' => $track,
            'week' => $week,
        ]);
    }
}
