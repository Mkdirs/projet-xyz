<?php

namespace App\Http\Controllers;

use App\Models\Track;
use App\Models\Week;
use App\Models\YoutubePlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackController extends Controller
{
    public function index(Request $request, Track $track){

        $week = $track->week;

        $player = new YoutubePlayer();
        $position = $request->query('position');

        return view('app.tracks.show', [
            'track' => $track,
            'week' => $week,
            'player' => $player,
            'position' => $position
        ]);
    }

    public function contribute(Request $request){
        return redirect()->route('track.contribute.show', ['week' => Week::current()]);
    }

    public function show(Request $request, Week $week){
        return view('app.tracks.create', [
            'week' => $week
        ]);
    }

    public function create(Request $request, Week $week){
        $validated = $request->validate([
            'title' => 'required|string',
            'artist' => 'required|string',
            'url' => 'required|url'
        ]);

        Track::create([
            'title' => $validated['title'],
            'artist' => $validated['artist'],
            'play_url' => $validated['url'],
            'contributer_id' => Auth::user()->id,
            'week_id' => $week->id
        ]);

        return redirect()->route('weeks.index', ['week' => $week]);
    }
}
