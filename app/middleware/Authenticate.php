<?php

class Authenticate
{
	public function redirectTo($request)
	{
		if (Auth::user()->role == 'admin') {
            return $next($request);
        }
	}
}
