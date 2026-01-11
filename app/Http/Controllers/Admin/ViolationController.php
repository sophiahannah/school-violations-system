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
    public function index()
    {
        $violations = Violation::all();

        $violationRecords = ViolationRecord
            ::with(['status', 'user', 'violationSanction.violation', 'violationSanction.sanction', 'appeal'])
            ->latest()
            ->paginate(10);

        $violationRecordCount = ViolationRecord::all()->count();

        $under_reviewCount = ViolationRecord::where('status_id', 1)->count();

        $pendingCount = ViolationRecord::where('status_id', 2)->count();

        $resolvedCount = ViolationRecord::where('status_id', 3)->count();

        $statuses = Status::all();

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

        return redirect()->route('violations-management.index');
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
        //
    }

    /**
     * Update the specified violation in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}
