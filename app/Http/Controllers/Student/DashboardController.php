<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $violationRecords = $user->violationRecords()
         ->with(['status', 'violationSanction.violation', 'violationSanction.sanction'])
         ->latest()
         ->get();
         
        $violationCount = $violationRecords->count();
 
        // compact data to frontend
        return view('student.dashboard', compact('user','violationCount', 'violationRecords'));
    }
}
