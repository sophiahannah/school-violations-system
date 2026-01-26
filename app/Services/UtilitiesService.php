<?php

namespace App\Services;

use App\Models\ViolationRecord;
use App\Models\ViolationSanction;
use Illuminate\Support\Facades\Mail;

class UtilitiesService
{

    /**
     * After an update to a student's records (UPDATE/DELETE), update their records to the correct number of offense.
     */
    public function updateViolations($record)
    {
        $user_id = $record->user_id;
        $violation_id = $record->violationSanction->violation_id;

        // Fetch all violations of this violation except the current record
        $violations = ViolationRecord::where('user_id', $user_id)
            ->where('id', '<>', $record->id)
            ->where('status_id', '<>', 4)
            ->whereHas('violationSanction', function ($q) use ($violation_id) {
                $q->where('violation_id', $violation_id);
            })
            ->orderBy('created_at', 'asc')
            ->with('violationSanction')
            ->get();

        $offense_number = 1;
        foreach ($violations as $violation) {
            // Get new sanction based on offense number
            $new_vio_sanct_id = $this->determineViolationSanction($violation_id, $offense_number);

            // Only update if different
            if ($violation->vio_sanct_id !== $new_vio_sanct_id) {
                $violation->update([
                    'vio_sanct_id' => $new_vio_sanct_id,
                ]);
            }

            $offense_number++;
        }
    }


    /**
     * Determine the violation_sanction_id
     */

    public function determineViolationSanction($violation_id, $violation_count)
    {
        $vio_sanct_id = ViolationSanction::where('violation_id', $violation_id)
            ->where('no_of_offense', $violation_count)
            ->get('id')
            ->first()
            ->id;

        return $vio_sanct_id;
    }

    /**
     * Get the maximum offense of a violation
     */
    private function getMaxOffense($violation_id)
    {
        return ViolationSanction::where('violation_id', $violation_id)->orderBy('no_of_offense', 'desc')->get()->first()->no_of_offense;
    }

    /**
     * Determine the current offense count of a student on a specific violation
     */
    private function getCurrentOffenseCount($user_id, $violation_id)
    {
        $record = ViolationRecord::join('violation_sanctions', 'violation_records.vio_sanct_id', '=', 'violation_sanctions.id')
            ->where('violation_records.user_id', $user_id)
            ->where('violation_sanctions.violation_id', $violation_id)
            ->where('status_id', '<>', 4)
            ->latest('no_of_offense')
            ->get();

        return  $record->count() ?? 0;
    }

    /**
     * Send Email for Violation
     */
    public function sendViolationEmail(ViolationRecord $record, $mailable)
    {
        // Ensure related data and user email are available
        $record->loadMissing(['status', 'user', 'violationSanction.violation', 'violationSanction.sanction', 'appeal']);

        $user = $record->user;

        if (! $user || ! $user->email) {
            return;
        }

        Mail::to('joshua123.jdr@gmail.com')->send($mailable);
    }

    /**
     * Get the next offense count of the student on a specific violation
     */
    public function countViolationOfStudent($user_id, $violation_id)
    {
        $max_offenses = $this->getMaxOffense($violation_id);

        $violation_count = $this->getCurrentOffenseCount($user_id, $violation_id);

        if ($violation_count < $max_offenses) {
            $violation_count = $violation_count + 1;
            return $violation_count;
        }

        return $violation_count;
    }
}
