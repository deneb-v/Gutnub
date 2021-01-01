<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ProjectAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $projectID = $request->route()->parameter('id');
        $user = Auth::user();
        $project = $user->projectMember->where('projectID', $projectID)->first();
        if($project == null){
            return back();
        }
        return $next($request);
    }
}
