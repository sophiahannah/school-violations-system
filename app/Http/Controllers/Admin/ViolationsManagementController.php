<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ViolationRecord;

class ViolationsManagementController extends Controller
{
    public function index() {

        $violationRecords = ViolationRecord::all();

        $violationRecordCount = ViolationRecord::all()->count();

        return view('admin.violations-management', compact('violationRecords'));
    }
}
