<?php

namespace App\Http\Middleware\Admin\Positions;

use App\Extenders\BaseMiddleware as Middleware;

class PositionMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.positions.crud'];
    }
}
