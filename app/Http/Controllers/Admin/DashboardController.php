<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Models\Violation;
use App\Models\ViolationRecord;
use App\Models\Appeal;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Summary counts
        $summary = [
            'total_violations' => ViolationRecord::count(),
            'under_review' => ViolationRecord::where('status_id', 1)->count(),
            'pending' => ViolationRecord::where('status_id', 2)->count(),
            'resolved' => ViolationRecord::where('status_id', 3)->count(),
        ];

        $recentViolations = ViolationRecord::with(['user', 'status', 'violationSanction.violation'])
            ->latest()
            ->take(5)
            ->get();

        $recentAppeals = Appeal::with(['violationRecord.user', 'violationRecord.violationSanction.violation'])
            ->latest('updated_at')
            ->take(4)
            ->get();

        $chartOptions = [
            'chart_title' => 'Violations in past 7 Days',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\ViolationRecord',
            'group_by_field' => 'created_at',
            'chart_type' => 'bar',
            'chart_color' => '255, 215, 215',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'filter_days' => 7,
        ];

        $violationsChart = new LaravelChart($chartOptions);

        return view('admin.dashboard', compact(
            'summary',
            'recentViolations',
            'recentAppeals',
            'violationsChart'
        ));
    }
}
