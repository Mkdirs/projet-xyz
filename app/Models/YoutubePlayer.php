<?php

namespace App\Models;

use App\Models\Player;

class YoutubePlayer implements Player
{

    function embed(string $url): string
    {
        //https://youtube.be/<id>
        $parts = explode('/', $url);

        $id = $parts[count($parts) - 1];

        return "https://www.youtube.com/embed/" . $id;
    }

    function thumbnail(string $url): string
    {

        $parts = explode('/', $url);

        $id = $parts[count($parts) - 1];
        return "https://img.youtube.com/vi/" . $id . "/default.jpg";
    }
}
