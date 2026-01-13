<?php

namespace Database\Factories;

use App\Models\Appeal;
use App\Models\ViolationRecord;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appeal>
 */
class AppealFactory extends Factory
{
    protected $model = Appeal::class;

    public function definition(): array
    {
        $violation = ViolationRecord::whereDoesntHave('appeal') // no existing appeal
            ->where('status_id', 1)
            ->inRandomOrder()
            ->first();

        $violationId = $violation->id ?? ViolationRecord::inRandomOrder()->value('id');

        return [
            'appeal_content' => fake()->paragraph(),
            'violation_record_id' => $violationId,
        ];
    }
}
