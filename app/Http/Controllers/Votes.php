<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Votes extends Controller
{
    public $totalVotes = 0;
    public $perVotes;

    public function __construct($poll)
    {
        foreach(json_decode($poll->options) as $option)
        {
            $this->totalVotes += $option->count;
        }
    }
}
