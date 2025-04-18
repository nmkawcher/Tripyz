<?php

namespace App\Http\Middleware;

use App\Constants\Status;
use Closure;

class MaintenanceMode
{
    public function handle($request, Closure $next)
    {
        if (gs('maintenance_mode') == Status::ENABLE) {
            if ($request->is('api/*')) {
                $notify[] = 'Our application is currently in maintenance mode';
                return apiResponse('maintenance_mode','error', $notify);
            }else{
                return to_route('maintenance');
            }
        }
        return $next($request);
    }
}
