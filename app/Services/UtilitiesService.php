<?php

namespace App\Services;

use App\Models\ViolationRecord;
use App\Models\ViolationSanction;
use Illuminate\Support\Facades\Mail;

class UtilitiesService {

    /**
     * After an update to a student's records (UPDATE/DELETE), update their records to the correct number of offense.
     */
    public function updateViolations($violationRecordId) {
        // Needed to obtain the violation record, which is needed to get the user's id.
        $violation_record =  ViolationRecord::findOrFail($violationRecordId);
        $user_id = $violation_record -> user_id;
        
        // Needed to get the violation_id, which is needed for the conditional in the loop to get only those records who correspond to a certain type of violation.
        $vio_sanct_id = $violation_record -> vio_sanct_id;
        $violation_sanction = ViolationSanction::findOrFail($vio_sanct_id);
        $violation_id = $violation_sanction -> violation_id;

        // Is a list of the student's violations.
        $user_violations = ViolationRecord::where('user_id', $user_id)
                                            ->where('id', '<>', $violationRecordId)
                                            ->where('status_id', '<>', 4)
                                            ->orderBy('id', 'desc')
                                            ->get();
        $count_of_violations = ViolationRecord::join('violation_sanctions', 'violation_records.vio_sanct_id', 'violation_sanctions.id')
                                                ->where('violation_sanctions.violation_id', $violation_id)
                                                ->where('violation_records.id', '<>', $violationRecordId)
                                                ->where('status_id', '<>', 4)
                                                ->count();

        $array = [];

        foreach($user_violations as $user_violation) {  
            $vio_sanct_id = $user_violation -> vio_sanct_id;
            $violation_sanction = ViolationSanction::findOrFail($vio_sanct_id);

            // Filters records so that only records with corresponding violation_id are added to the array;
            if ($violation_sanction->violation_id == $violation_id) {
                $no_of_offense = $count_of_violations;

                $new_vio_sanct_id = $this->determineViolationSanction($violation_id, $no_of_offense);

                $user_violation->update([
                    'vio_sanct_id' => $new_vio_sanct_id,
                ]);

                $array[] = $user_violation;
            }

            $count_of_violations--;
        }

        return $array;
    }

     /**
     * Determine the violation_sanction_id
     */

    public function determineViolationSanction($violation_id, $violation_count) {
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
            ->get()
            ->first();

        return $record->no_of_offense ?? 0;
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