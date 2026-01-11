<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sanction;
use Illuminate\Http\Request;

class SanctionController extends Controller
{
    public function index()
    {
        $sanctions = Sanction::latest()->get();
        $sanctionCount = $sanctions->count();

        return view('admin.sanction', compact('sanctions', 'sanctionCount'));
    }
}
