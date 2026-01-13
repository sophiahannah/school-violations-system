<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViolationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('violations')->insert([
            ['id' => 1, 'violation_name' => "Non-Validated ID"],
            ['id' => 2, 'violation_name' => "Not wearing ID/No Registration Card/No Student's Entry Slip (SES)"],
            ['id' => 3, 'violation_name' => "Loss of ID/Registration Card"],
            ['id' => 4, 'violation_name' => "Fake ID/Another person's ID/Lending of ID"],
            ['id' => 5, 'violation_name' => "Failure to secure ID on time"],
            ['id' => 6, 'violation_name' => "Inappropriate attire"],
            ['id' => 7, 'violation_name' => "Overnight stay in university"],
            ['id' => 8, 'violation_name' => "Unauthorized use of university Name/Logo/Seal"],
            ['id' => 9, 'violation_name' => "Damage to university facilities"],
            ['id' => 10, 'violation_name' => "Unofficial or unauthorized participation in any off-campus activity"],
            ['id' => 11, 'violation_name' => "Unauthorized release to the press/similar channels of public communication notices and other announcements about or on behalf of the university"],
            ['id' => 12, 'violation_name' => "Unauthorized entry of visitors/guests invited by students/organizations (e.g., lecturers, speakers, seminar participants, viewers of exhibits, and the like."],
            ['id' => 13, 'violation_name' => "Illegal posting of bills, posters, tarpaulins, and the like"],
            ['id' => 14, 'violation_name' => "Littering"],
            ['id' => 15, 'violation_name' => "Smoking (including vape/e-cigarette"],
            ['id' => 16, 'violation_name' => "Intoxicated while on campus/Bringing in intoxicating drinks into University premises"],
            ['id' => 17, 'violation_name' => "Gambling"],
            ['id' => 18, 'violation_name' => "Use of internet/IT facilities for gaming, pornography, cyberbullying, etc."],
            ['id' => 19, 'violation_name' => "Theft"],
            ['id' => 20, 'violation_name' => "Vandalism"],
            ['id' => 21, 'violation_name' => "Destruction/Intentional damage to University/other person's property"],
            ['id' => 22, 'violation_name' => "Deliberate disruption of classes, academic function, official meeting or school activity"],
            ['id' => 23, 'violation_name' => "Gross acts of disrespect"],
            ['id' => 24, 'violation_name' => "Public and malicious accusation which causes dishonor, discredit, or contempt of the University and its reputation"],
            ['id' => 25, 'violation_name' => "Direct or indirect assault"],
            ['id' => 26, 'violation_name' => "Scandalous display of affection"],
            ['id' => 27, 'violation_name' => "Brawls on campus or at off-campus school functions"],
            ['id' => 28, 'violation_name' => "Tampering/Falsifying official ddocuments"],
            ['id' => 29, 'violation_name' => "Dishonesty/Plagiarism"],
            ['id' => 30, 'violation_name' => "Carrying of deadly weapons"],
            ['id' => 31, 'violation_name' => "All forms of bullying and/or harassment, threat, and intimidation"],
            ['id' => 32, 'violation_name' => "Filing of a false or inaccurate application form for the conduct of an initiation rite which does not constitute hazing"],
            ['id' => 33, 'violation_name' => "Holding of an initiation rite that does not constitute hazing without approval from the University"],
            ['id' => 34, 'violation_name' => "Hazing"],
            ['id' => 35, 'violation_name' => "Sexual Harassment"],
            ['id' => 36, 'violation_name' => "Possession or use of prohibited drugs, such as LSD, marijuana,  heroin, shabu or opiate of any kind"],
            ['id' => 37, 'violation_name' => "Submission of falsified documents for admission"],
        ]);
    }
}
