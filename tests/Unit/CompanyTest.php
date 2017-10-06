<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    public function testCreateCompanyWithoutParentSuccess()
    {
        \DB::beginTransaction();

        $user = User::find(1);

        $response = $this->post('/api/v1/company/create', [
            'name' => 'Test company',
            'description' => 'Test company description',
            'created_by' => $user->id
        ]);

        $response->assertJsonFragment([
            'status' => 1
        ]);
    }

    public function testCreateCompanyWithParentSuccess()
    {
        \DB::beginTransaction();

        $user = User::find(1);

        $this->post('/api/v1/company/create', [
            'name' => 'Test company',
            'description' => 'Test company description',
            'created_by' => $user->id
        ]);

        $response = $this->post('/api/v1/company/create', [
            'name' => 'Test company',
            'description' => 'Test company description',
            'created_by' => $user->id,
            'parent_company_id' => 1
        ]);

        $response->assertJsonFragment([
            'status' => 1
        ]);
    }
}
