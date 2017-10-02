<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    public function testApiUserRegistrationSuccess()
    {
        \DB::beginTransaction();

        $createdUserResponse = $this->post('/api/v1/auth/register', [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@user.com',
            'password' => '123123123'
        ]);

        $createdUserResponse->assertJsonFragment([
            'status' => 1
        ]);
    }

    public function testApiUserRegistrationErrorDuplicate()
    {
        \DB::beginTransaction();

        $createdUserResponse = $this->post('/api/v1/auth/register', [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@user.com',
        ]);

        $createdUserResponse->assertJsonFragment([
            'status' => 0
        ]);
    }

    public function testApiUserLoginSuccess()
    {
        $receivedUserResponse = $this->post('/api/v1/auth/login', [
            'email' => 'worldstes@gmail.com',
            'password' => '123123123'
        ]);

        $receivedUserResponse->assertJsonFragment([
            'status' => 1
        ]);
    }

    public function testApiUserLoginError()
    {
        $response = $this->post('/api/v1/auth/login', [
            'email' => 'test@user.com',
            'password' => '123123'
        ]);

        $response->assertJsonFragment([
            'status' => 0
        ]);
    }
}
