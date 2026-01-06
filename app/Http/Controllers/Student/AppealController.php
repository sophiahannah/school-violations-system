<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppealRequest;
use App\Models\Appeal;
use App\Models\ViolationRecord;
use Illuminate\Http\Request;

class AppealController extends Controller
{
    public function store(AppealRequest $request)
    {
        $violation = ViolationRecord::findOrFail($request->violation_record_id);

        if(!$violation->canBeAppealed()){
            return back()->withErrors([
                'appeal' => 'This violation can no longer be Appealed',
            ]);
        }

        Appeal::create([
            'appeal_content' => $request->appeal_content,
            'violation_record_id' => $request->violation_record_id
        ]);

        return redirect()->back()->with('success', 'Appeal submitted successfully.');
    }
}
