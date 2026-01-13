<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status')->insert([
            ['id' => 1,    'status_name' => 'Under review'],
            ['id' => 2,    'status_name' => 'In progress'],
            ['id' => 3,    'status_name' => 'Resolved'],
            ['id' => 4,    'status_name' => 'Sanction revoked'],
        ]);
    }
}
