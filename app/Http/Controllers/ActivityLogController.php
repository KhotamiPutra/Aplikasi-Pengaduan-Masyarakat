<?php

namespace App\Http\Controllers;

use App\Models\actifitylog;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        $putra_actifitylog = actifitylog::all();
        return view('admin.activitylog', compact('putra_actifitylog'));
    }
}
