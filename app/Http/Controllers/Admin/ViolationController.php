<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ViolationRequest;
use App\Models\Status;
use App\Models\User;
use App\Models\Violation;
use App\Models\ViolationRecord;
use App\Models\ViolationSanction;
use App\Services\UtilitiesService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ViolationController extends Controller
{
    protected $utilitiesService;

    public function __construct(UtilitiesService $utilitiesService)
    {
        $this->utilitiesService = $utilitiesService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get Data
        $violations = Violation::all();
        $statuses = Status::all();
        $violationRecords = ViolationRecord::with(['status', 'user', 'violationSanction.violation', 'violationSanction.sanction', 'appeal']);

        // Get search input
        $search = $request->input('search');
        if ($search) {
            $violationRecords->whereHas('user', function ($q) use ($search) {
                $q->where('school_id', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%{$search}%"]);
            });
        }

        // Apply status filter
        $statusId = $request->input('status');
        if ($statusId && $statusId !== 'all') {
            $violationRecords->where('status_id', $statusId);
        }

        // Summary Cards
        $violationCount = $violationRecords->count();
        $under_reviewCount = ViolationRecord::where('status_id', 1)->count();
        $pendingCount = ViolationRecord::where('status_id', 2)->count();
        $resolvedCount = ViolationRecord::where('status_id', 3)->count();

        // Paginate Violation Record
        $violationRecords = $violationRecords->latest()->paginate(10);

        return view(
            'admin.violations-management',
            compact(
                'violations',
                'violationRecords',
                'violationCount',
                'under_reviewCount',
                'pendingCount',
                'resolvedCount',
                'statuses',
            )
        );
    }

    /**
     * Store a newly created violation in storage.
     */
    public function store(ViolationRequest $request)
    {
        $data = $request->validated();

        // Get Data
        $student_id = $data['student_id'];
        $violation_id = $data['violation_id'];
        $notes = $data['description'] ?? null;
        $user_id = User::where('role_id', 1)->where('school_id', $student_id)->value('id');

        // Get Next Offense Count
        $violation_count = $this->utilitiesService->countViolationOfStudent($user_id, $violation_id);

        // Get Violation-Sanction
        $vio_sanct_id = $this->utilitiesService->determineViolationSanction($violation_id, $violation_count);

        // Insert
        $record = ViolationRecord::create([
            'user_id' => $user_id,
            'vio_sanct_id' => $vio_sanct_id,
            'notes' => $notes,
            'status_id' => 1,
        ]);

        // Send Email notification
        // $this->violationService->sendViolationEmail($record, new ViolationRecordedMail($record));

        session()->flash('response', 'Violation record created.');
        return redirect()->route('admin.violations-management.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Update the specified violation in storage.
     */
    public function update(ViolationRecord $violations_management)
    {

        $violation_id = request('violation_id');

        $user_id = $violations_management->user->id;
        $prev_vio_sanct_id = $violations_management->vio_sanct_id;
        $prev_violation_id = ViolationSanction::where('id', $prev_vio_sanct_id)->get('violation_id')->first()->violation_id;

        // If the current record's violation_id and newly-entered violation_id are the same, do nothing.
        if (strcmp($violation_id, $prev_violation_id) == 0) {
            session()->flash('response', 'Violation has not been changed.');
            return redirect()->route('admin.violations-management.index');
        }

        // If the current record's violation_id and newly-entered violation_id are different
        $violation_count = $this->utilitiesService->countViolationOfStudent($user_id, $violation_id);
        $vio_sanct_id = $this->utilitiesService->determineViolationSanction($violation_id, $violation_count);
        $this->utilitiesService->updateViolations($violations_management);

        $violations_management->update([
            'vio_sanct_id' => $vio_sanct_id,
            'status_id' => 1,
            'updated_at' => Carbon::now(),
        ]);

        session()->flash('response', 'Violation record updated.');

        return redirect()->route('admin.violations-management.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ViolationRecord $violations_management)
    {
        $this->utilitiesService->updateViolations($violations_management);

        $violations_management->delete();

        session()->flash('response', 'Violation record deleted.');

        return redirect()->route('admin.violations-management.index');
    }

    /**
     * Mark a violation record as resolved.
     */
    public function resolve(ViolationRecord $violations_management)
    {

        $violations_management->update([
            'status_id' => 3,
        ]);

        session()->flash('response', 'Violation record resolved.');

        return redirect()->route('admin.violations-management.index');
    }
}
