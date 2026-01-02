<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViolationOverviewController extends Controller
{
    public function index()
    {
        return view('student.violation-overview');
    }
}
