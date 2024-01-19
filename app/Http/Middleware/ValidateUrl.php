<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $url = $request->input('img_url'); // Assuming the URL is in the request parameters
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            // Invalid URL, redirect to welcome page with an error message
            return redirect('/')->with('error', 'Invalid URL. Please provide a valid URL.');
        }

        return $next($request);
    }
}
