<?php

namespace Database\Factories;

use App\Models\Appeal;
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
        return [
            'appeal_content' => fake()->paragraph(),
            'violation_record_id' => DB::table('violation_records')->inRandomOrder()->value('id') ?? 1,
        ];
    }
}
