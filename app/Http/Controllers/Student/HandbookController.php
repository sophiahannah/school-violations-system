<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Violation;
use Illuminate\Support\Facades\DB;

class HandbookController extends Controller
{
    public function index()
    {
        // Get all violations with their sanctions
        $violations = DB::table('violations')
            ->select(
                'violations.id as violation_id',
                'violations.violation_name',
                'violation_sanctions.no_of_offense',
                'sanctions.sanction_name'
            )
            ->join('violation_sanctions', 'violations.id', '=', 'violation_sanctions.violation_id')
            ->join('sanctions', 'violation_sanctions.sanction_id', '=', 'sanctions.id')
            ->orderBy('violations.violation_name', 'asc')
            ->orderBy('violation_sanctions.no_of_offense', 'asc')
            ->get()
            ->groupBy('violation_id');

        return view('student.handbook', compact('violations'));
    }
}
