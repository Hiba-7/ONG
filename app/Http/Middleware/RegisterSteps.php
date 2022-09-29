<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RegisterSteps
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
        if ($request->route()->getName() == 'register.step.two') {
            if (!$request->session()->get('steps.step-one')) {

                return redirect()->route('register.step.one');
            }
        } elseif ($request->route()->getName() == 'register.step.three') {
            if (!$request->session()->get('steps.step-two')) {
                return redirect()->route('register.step.two');
            }
        } elseif ($request->route()->getName() == 'register.step.four') {
            if (!$request->session()->get('steps.step-three')) {
                return redirect()->route('register.step.three');
            }
        }
        return $next($request);
    }
}
