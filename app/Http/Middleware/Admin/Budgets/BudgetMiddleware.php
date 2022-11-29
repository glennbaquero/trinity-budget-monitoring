<?php

namespace App\Http\Middleware\Admin\Budgets;

use App\Extenders\BaseMiddleware as Middleware;

class BudgetMiddleware extends Middleware
{
    public function __construct() {
        $this->permissions = ['admin.budgets.crud'];
    }
}
