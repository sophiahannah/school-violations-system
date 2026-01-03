<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ViolationRecord;

class DashboardController extends Controller
{
    public function index() {

        $violationRecords = ViolationRecord::all();

        $violationRecordCount = ViolationRecord::all()->count();

        $under_reviewCount = ViolationRecord::where('status_id', 1)->count();

        $pendingCount = ViolationRecord::where('status_id', 2)->count();

        $resolvedCount = ViolationRecord::where('status_id', 3)->count();

        return view('admin.dashboard', compact('violationRecords', 'violationRecordCount', 'under_reviewCount', 'pendingCount', 'resolvedCount'));
    }
}
