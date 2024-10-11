<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index(Request $request, Track $track){

        return view('app.tracks.show')
            ->with('track', $track);
    }
}
