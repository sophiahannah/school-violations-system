<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SanctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sanctions')->insert([
            ['id' => 1, 'sanction_name' => "Warning slip by the Student Affairs Section of OSS"],
            ['id' => 2, 'sanction_name' => "1 week suspension"],
            ['id' => 3, 'sanction_name' => "2 weeks suspension"],
            ['id' => 4, 'sanction_name' => "1 month suspension"],
            ['id' => 5, 'sanction_name' => "Warning and payment for the cost of printing of new ID"],
            ['id' => 6, 'sanction_name' => "Warning and requiring of 16-hour student assistance service to be rendered within 5 school days upon report of loss, on top of payment for the cost of ID printing"],
            ['id' => 7, 'sanction_name' => "24-hour student-assistance service to be rendered within 7 schooldays, and payment for the ost of ID printing."],
            ['id' => 8, 'sanction_name' => "1 semester suspension"],
            ['id' => 9, 'sanction_name' => "Dismissal from the University"],
            ['id' => 10, 'sanction_name' => "3 hours campus service"],
            ['id' => 11, 'sanction_name' => "6 hours campus service"],
            ['id' => 12, 'sanction_name' => "2 day suspension"],
            ['id' => 13, 'sanction_name' => "Failing grade in the examination/quiz"],
            ['id' => 14, 'sanction_name' => "Failing grade in the course"],
            ['id' => 15, 'sanction_name' => "Dismissal, and filing of criminal case"],
            ['id' => 16, 'sanction_name' => "Expulsion"],
            ['id' => 17, 'sanction_name' => "1 day campus service"],
            ['id' => 18, 'sanction_name' => "1 week campus service"],
            ['id' => 19, 'sanction_name' => "1 month campus service"],
            ['id' => 20, 'sanction_name' => "Action on Drug Test Result"],
            ['id' => 21, 'sanction_name' => "One-week suspension of the incumbent  officers and all members who participated"],
            ['id' => 22, 'sanction_name' => "Two-week suspension of the incumbent  officers and all members who participated"],
            ['id' => 23, 'sanction_name' => "Expulsion of all incumbent officers, all members present  during the hazing, members who has actual knowledge of  hazing, and all members who participated in the planning of  hazing; and revocation of the registration of the organization"],
            ['id' => 24, 'sanction_name' => "Handled by SDB from ODSS"],
            ['id' => 25, 'sanction_name' => "Revocation of degree"],
        ]);
    }
}
