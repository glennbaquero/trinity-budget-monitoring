<?php

namespace App\Http\Middleware\Admin\Specializations;

use App\Extenders\BaseMiddleware as Middleware;

class SpecializationMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.specializations.crud'];
    }
}
