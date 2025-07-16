<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;

class AdminLogController extends Controller
{
    public function index()
    {
        $logs = AdminLog::latest()->paginate(10);
        return view('dashboard.aktivitas', compact('logs'));
    }
}
