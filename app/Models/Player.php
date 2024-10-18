<?php

namespace App\Models;

interface Player
{
    function embed(string $url):string;

    function thumbnail(string $url):string;
}
