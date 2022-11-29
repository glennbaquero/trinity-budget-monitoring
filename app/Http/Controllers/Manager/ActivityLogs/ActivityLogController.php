<?php

namespace App\Http\Controllers\Web\ActivityLogs;

use App\Extenders\Controllers\ActivityLogs\ActivityLogController as Controller;

class ActivityLogController extends Controller
{
    protected $indexView = 'manager.activity-logs.index';
}
