<?php

namespace Tests\Unit\App\Http\Controllers;

use App\Models\Expenditure;
use App\Models\User;
use Tests\TestCase;

class ExpenditureControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_user_should_not_create_expenditure(): void
    {
        $this
            ->get('/api/v1/expenditure/')
            ->assertUnauthorized(401);
    }

    public function test_user_should_create_expenditure(): void
    {
        $user = User::factory()->create();

        $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);

        $this
            ->withHeaders([
                'Authorization' => "Bearer {$token}"
            ])
            ->postJson('/api/v1/expenditure/', [
                'description' => 'Curso fullcycle',
                'value' => 3167.89
            ])
            ->assertStatus(200);

        $this->assertEquals('Curso fullcycle', $user->expenditure[0]->description);
        $this->assertEquals(3167.89, $user->expenditure[0]->value);
    }

    public function test_user_should_update_expenditure(): void
    {
        $expenditure = Expenditure::factory()->create();

        $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($expenditure->user);

        $this
            ->withHeaders([
                'Authorization' => "Bearer {$token}"
            ])
            ->putJson("/api/v1/expenditure/{$expenditure->id}", [
                'description' => 'Kubernets',
                'value' => 217.89
            ])
            ->assertStatus(200);

        $updatedExpenditure = $expenditure->user->expenditure[0];
        
        $this->assertEquals('Kubernets', $updatedExpenditure->description);
        $this->assertEquals(217.89, $updatedExpenditure->value);
    }

    public function test_user_should_not_see_expenditure_from_other_user(): void
    {
        $otherUser = User::factory()->create();
        $expenditure = Expenditure::factory()->create();

        $otherUserToken = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($otherUser);

        $this
            ->withHeaders([
                'Authorization' => "Bearer {$otherUserToken}"
            ])
            ->getJson("/api/v1/expenditure/{$expenditure->id}")
            ->assertStatus(403);
    }

    public function test_user_should_not_delete_expenditure_from_other_user(): void
    {
        $otherUser = User::factory()->create();
        $expenditure = Expenditure::factory()->create();

        $otherUserToken = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($otherUser);

        $this
            ->withHeaders([
                'Authorization' => "Bearer {$otherUserToken}"
            ])
            ->deleteJson("/api/v1/expenditure/{$expenditure->id}")
            ->assertStatus(403);
    }

    public function test_user_should_not_update_expenditure_with_wrong_request_value(): void
    {
        $expenditure = Expenditure::factory()->create();

        $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($expenditure->user);

        $this
            ->withHeaders([
                'Authorization' => "Bearer {$token}"
            ])
            ->putJson("/api/v1/expenditure/{$expenditure->id}", [
                'description' => 'Kubernets',
                'value' => 999999991.99
            ])
            ->assertStatus(400);
    }
}
