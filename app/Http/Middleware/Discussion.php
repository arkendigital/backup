<?php

namespace App\Http\Middleware;

use Closure;

class Discussion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

      /**
      * Get discussion id.
      *
      */
      $discussion_id = $request->route()->parameters()["discussion"]["id"];

      /**
      * Check owner.
      *
      */
      if (auth()->check() && auth()->user()->id == $discussion_id) {
        return $next($request);
      }

      /**
      * Check admin.
      *
      */
      else if (auth()->check() && auth()->user()->hasRole("Super Administrator|Administrator")) {
        return $next($request);
      }

      else {
        return redirect("404");
      }
    }
}
