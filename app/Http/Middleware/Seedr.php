<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Polls;

class Seedr
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next)
    {

        if (config("sets.app.seedr")) 
        {
            $polls = Polls::where('status', '=', 'open')->get();

            foreach ($polls as $poll) 
            {
                $poll->views += random_int(7, 10);

                $poll->options = json_encode((object)array_map(function ($optn) {
                    $optn->count += random_int(0, 2);
                    return $optn;
                }, ((array)json_decode($poll->options))));

                $poll->save();
            }
        }

        return $next($request);
    }
}
