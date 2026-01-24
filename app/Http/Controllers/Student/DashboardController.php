<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ViolationRecord;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $violationRecords = $user->violationRecords()
            ->with(['status', 'violationSanction.violation', 'violationSanction.sanction', 'appeal'])
            ->latest();
            
        $violationCount = $violationRecords->count();

        $statuses = Status::all();

        $statusId = request('status');

        if ($statusId && $statusId !== 'all') {
            $violationRecords = $violationRecords->where('status_id', $statusId);
        }

        $violationRecords = $violationRecords->latest()->paginate(10);

        // return response()->json($violationRecords);
        // compact data to frontend
        return view('student.dashboard', compact('user', 'violationCount', 'violationRecords', 'statuses'));
    }


    public function show(ViolationRecord $violationRecord)
    {
        $user = Auth::user();

        $violationRecords = $user->violationRecords()
            ->with(['status', 'violationSanction.violation', 'violationSanction.sanction', 'appeal'])
            ->latest()
            ->get();

        $violationCount = $violationRecords->count();

        $record = $user->violationRecords()
            ->with(['status', 'violationSanction.violation', 'violationSanction.sanction', 'appeal'])
            ->findOrFail($violationRecord->id);

        $timeline = [];

        $timeline[] = [
            'title' => 'Violation Reported',
            'description' => 'The violation was recorded in the system.',
            'timestamp' => $record->created_at,
        ];

        if ($record->appeal) {
            $timeline[] = [
                'title' => 'Appeal Submitted',
                'description' => 'You submitted an appeal for this violation.',
                'timestamp' => $record->appeal->created_at,
            ];

            if (!is_null($record->appeal->is_accepted)) {
                $timeline[] = [
                    'title' => $record->appeal->is_accepted ? 'Appeal Approved' : 'Appeal Denied',
                    'description' => 'Your appeal has been reviewed by the faculty.',
                    'timestamp' => $record->appeal->updated_at,
                ];
            }
        }

        $timeline[] = [
            'title' => 'Current Status: ' . $record->status->status_name,
            'description' => 'Latest status of this violation record.',
            'timestamp' => $record->updated_at,
        ];

        // Latest events at the top of the timeline
        $timeline = array_reverse($timeline);

        return view('student.violation-show', compact(
            'user',
            'violationRecords',
            'violationCount',
            'record',
            'timeline'
        ));
    }
}
