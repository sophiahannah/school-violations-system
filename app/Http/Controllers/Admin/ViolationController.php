<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ViolationRecord;
use Illuminate\Http\Request;

class ViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $violationRecords = ViolationRecord::all();

        $violationRecordCount = ViolationRecord::all()->count();

        return view('admin.violations-management', compact('violationRecords'));
    }

    /**
     * Store a newly created violation in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
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
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
