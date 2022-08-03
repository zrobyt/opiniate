<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Polls;

class PollView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request,Closure $next,$id=null)
    {   
        if (isset($id))
        {
            $poll = Polls::where('id','=',$request->id)->get();
            $poll[0]->views++;
            $poll[0]->save();
        }

        return $next($request);
    }
}
