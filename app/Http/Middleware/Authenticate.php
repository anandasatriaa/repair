<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Redirect jika tidak terautentikasi.
     */
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            return route('admin.login'); // redirect ke halaman login admin
        }

        return null;
    }
}
