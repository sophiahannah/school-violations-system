<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Models\User;
use App\Models\Violation;
use App\Models\ViolationRecord;
use App\Models\ViolationSanction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $violations = Violation::all();

        // Get search input
        $search = $request->input('search');
        $statusId = $request->input('status');

        $violationRecords = ViolationRecord::with(['status', 'user', 'violationSanction.violation', 'violationSanction.sanction', 'appeal']);

        if ($search) {
            $violationRecords->whereHas('user', function ($q) use ($search) {
                $q->where('school_id', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%{$search}%"]);
            });
        }

        // Apply status filter
        if ($statusId && $statusId !== 'all') {
            $violationRecords->where('status_id', $statusId);
        }

        $violationRecordCount = (clone $violationRecords)->count();
        $under_reviewCount = ViolationRecord::where('status_id', 1)->count();
        $pendingCount = ViolationRecord::where('status_id', 2)->count();
        $resolvedCount = ViolationRecord::where('status_id', 3)->count();

        $statuses = Status::all();

        $violationRecords = $violationRecords->latest()->paginate(10)->withQueryString();

        // return response()->json($violationRecords);
        return view(
            'admin.violations-management',
            compact(
                'violations',
                'violationRecords',
                'violationRecordCount',
                'under_reviewCount',
                'pendingCount',
                'resolvedCount',
                'statuses'
            )
        );
    }

    /**
     * Store a newly created violation in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $student_id = request('student_id');
        $violation_id = request('violation_id');

        if ($student_id == null) {
            return 'Error:  Missing values (student_id or violation_id)'; // Add better error message here.
        }

        $user_id = $this->getUserId($student_id);
        $violation_count = $this->countViolationOfStudent($user_id, $violation_id);
        $vio_sanct_id = $this->determineViolationSanction($violation_id, $violation_count);
        $result = $this->insertNewViolation($user_id, $vio_sanct_id);

        if ($result == 0) {
            return "Error:  Action failed.";
        }

        return redirect()->route('admin.violations-management.index');
    }

    private function getUserId($student_id)
    {
        $user_id = User::where('role_id', 1)->where('school_id', $student_id)->get('id')->first();

        return $user_id->id ?? null;
    }

    private function countViolationOfStudent($user_id, $violation_id)
    {

        $max_offenses = ViolationSanction::where('violation_id', $violation_id)->orderBy('no_of_offense', 'desc')->get()->first()->no_of_offense;

        $max_offenses = intval($max_offenses);

        $violation_count = ViolationRecord::join('violation_sanctions', 'violation_records.vio_sanct_id', '=', 'violation_sanctions.id')
            ->where('violation_records.user_id', $user_id)
            ->where('violation_sanctions.violation_id', $violation_id)
            ->orderBy('no_of_offense', 'desc')
            ->get()
            ->first()
            ->no_of_offense ?? 0;

        $violation_count = intval($violation_count);

        if ($violation_count < $max_offenses) {

            $violation_count = $violation_count + 1;

            return $violation_count;
        }

        return $violation_count;
    }

    private function determineViolationSanction($violation_id, $violation_count)
    {
        $vio_sanct_id = ViolationSanction::where('violation_id', $violation_id)
            ->where('no_of_offense', $violation_count)
            ->get('id')
            ->first()
            ->id;

        return $vio_sanct_id;
    }

    private function insertNewViolation($user_id, $vio_sanct_id)
    {

        $result = ViolationRecord::insert([
            [
                'user_id' => $user_id,
                'vio_sanct_id' => $vio_sanct_id,
                'status_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null
            ]

        ]);

        return $result;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd('This is the SHOW controller.  Add @method to your form');
    }

    /**
     * Update the specified violation in storage.
     */
    public function update(ViolationRecord $violations_management, Request $request) {
    
        $violation_id = request('violation_id');    

        if ($violation_id == null) {
            return "Error:  Violation cannot be null.";
        }

        $user_id = $violations_management->user->id;
        $prev_vio_sanct_id = $violations_management->vio_sanct_id;
        $prev_violation_id = ViolationSanction::where('id', $prev_vio_sanct_id)->get('violation_id')->first()->violation_id;

        // If the current record's violation_id and newly-entered violation_id are the same, do nothing.
        if (strcmp($violation_id, $prev_violation_id) == 0) {
            return redirect()->route('admin.violations-management.index');
        } 

        // If the current record's violation_id and newly-entered violation_id are different
        $violation_count = $this->countViolationOfStudent($user_id, $violation_id);
        $vio_sanct_id = $this->determineViolationSanction($violation_id, $violation_count);

        $result = $violations_management->update([
            'vio_sanct_id' => $vio_sanct_id,
            'status_id' => 1,
            'updated_at'=> Carbon::now(),
        ]);

        if ($result == 0) {
            return "Error: Action failed";
        }
    
        return redirect()->route('admin.violations-management.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ViolationRecord $violations_management)
    {   
        $violations_management->delete();

        return redirect()->route('admin.violations-management.index');
    }
}
