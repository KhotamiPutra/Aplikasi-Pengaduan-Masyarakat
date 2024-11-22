<?php

namespace App\Http\Controllers;

use App\Models\actifitylog;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        $actifitylog = actifitylog::all();
        return view('admin.activitylog', compact('actifitylog'));
    }
}
