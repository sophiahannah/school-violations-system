<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Violation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViolationTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_admin_can_log_violation()
    {
        $admin = User::factory()->faculty()->create();
        $student = User::factory()->student()->create();
        $violation = Violation::find(1);

        $response = $this->actingAs($admin)->post('/admin/violations-management', [
            'student_id' => $student->school_id,
            'violation_id' => $violation->id,
        ]);

        $response->assertRedirect('/admin/violations-management');

        $this->assertDatabaseHas('violation_records', [
            'user_id' => $student->id,
            'vio_sanct_id' => $violation->violationSanctions()->first()->id,
        ]);
    }
}
