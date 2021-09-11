<?php

namespace App\Http\Middleware;

use App\Http\Traits\HasFixtures;
use App\Models\Fixture;
use Closure;
use DateTime;
use Illuminate\Http\Request;

class CheckMatchState
{
    use HasFixtures;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $match= Fixture::findOrFail($request->id);
        $current_time = new DateTime(now('Asia/Yangon'));
        $kickoff_time = new DateTime($match->kickoff_time);
        if($current_time > $kickoff_time)
        {//Update Fixture data
            $this->updateSingleFixture($match);
        }
        if($match->finished == true){
            return redirect()->route('home')->with('info','The match is already finished');
        }else if($match->started == true ){
            return redirect()->route('home')->with('info','The match is already started');
        }
        return $next($request);
    }
}