<?php

namespace Database\Seeders;

use App\Models\ViolationRecord;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViolationRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ViolationRecord::create([
            'user_id' => 2,
            'vio_sanct_id' => DB::table('violation_sanctions')->where('no_of_offense', 1)->inRandomOrder()->value('id') ?? 1,
            'status_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        ViolationRecord::factory()->count(10)->create();
    }
}
