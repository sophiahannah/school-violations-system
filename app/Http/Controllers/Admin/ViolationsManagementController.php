<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ViolationRecord;
use App\Models\ViolationSanction;
use Carbon\Carbon;

class ViolationsManagementController extends Controller
{
    public function index() {

        $violationRecords = ViolationRecord::all();

        $violationRecordCount = ViolationRecord::all()->count();

        return view('admin.violations-management', compact('violationRecords'));
    }

    public function logViolation(Request $request) {

        $student_id = request('student_id');
        $violation_id = request('violation_id');

        if ($student_id == null) {
            return 'Error:  Missing values (student_id or violation_id)'; // Add better error message here.
        }

        $user_id = $this->getUserId($student_id);
        $violation_records = $this->getStudentViolations($user_id);
        $violation_count = $this->countViolationOfStudent($user_id, $violation_id);
        $vio_sanct_id = $this->determineViolationSanction($violation_id, $violation_count);
        $result = $this->insertNewViolation($user_id, $vio_sanct_id);

        return view('admin.test', compact('user_id', 'violation_records', 'violation_id', 'violation_count', 'vio_sanct_id', 'result'));        
    }

    private function getUserId($student_id) {
        $user_id = User::where('role_id', 1)->where('school_id', $student_id)->get('id')->first();

        return $user_id->id ?? null;
    }

    private function getStudentViolations($user_id){
        return ViolationRecord::with('ViolationSanction.violation', 'ViolationSanction.sanction')->where('user_id', $user_id)->get();
    }

    private function countViolationOfStudent($user_id, $violation_id) { 

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

    private function determineViolationSanction($violation_id, $violation_count) {
        $vio_sanct_id = ViolationSanction::where('violation_id', $violation_id)
                                            ->where('no_of_offense', $violation_count)
                                            ->get('id')
                                            ->first()
                                            ->id;

        return $vio_sanct_id;
    }

    private function insertNewViolation($user_id, $vio_sanct_id) {

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

}
