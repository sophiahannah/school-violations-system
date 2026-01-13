<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\ViolationRecord;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ViolationRecord>
 */
class ViolationRecordFactory extends Factory
{
    protected $model = ViolationRecord::class;

    public function definition(): array
    {
        return [
            'user_id' => User::where('role_id', 1)->inRandomOrder()->value('id'),
            'vio_sanct_id' => DB::table('violation_sanctions')->where('no_of_offense', 1)->inRandomOrder()->value('id') ?? 1,
            'status_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
