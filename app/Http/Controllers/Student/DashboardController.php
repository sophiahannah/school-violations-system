<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppealRequest;
use App\Models\Appeal;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $violationRecords = $user->violationRecords()
            ->with(['status', 'violationSanction.violation', 'violationSanction.sanction', 'appeal'])
            ->latest()
            ->get();

        $violationCount = $violationRecords->count();

        $statuses = Status::all();
        
        $statusId = request('status');

        if ($statusId && $statusId !== 'all') {
            $violationRecords = $violationRecords->where('status_id', $statusId);
        }
        // return response()->json($violationRecords);
        // compact data to frontend
        return view('student.dashboard', compact('user', 'violationCount', 'violationRecords', 'statuses'));
    }
}
