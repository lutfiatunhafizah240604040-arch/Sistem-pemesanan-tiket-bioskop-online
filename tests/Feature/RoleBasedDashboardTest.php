<?php

use App\Models\User;

it('shows admin dashboard content for admin users and allows management pages', function (): void {
    $admin = User::factory()->create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
    ]);
    $admin->forceFill(['role' => 'admin'])->save();

    $response = $this->actingAs($admin)->get('/dashboard');

    $response->assertOk();
    $response->assertSee('Dashboard Admin');
    $response->assertSee('Panel kontrol');
    $this->actingAs($admin)->get('/movies')->assertStatus(200);
});

it('shows user dashboard content for regular users and blocks management pages', function (): void {
    $user = User::factory()->create([
        'name' => 'Regular User',
        'email' => 'user@example.com',
    ]);
    $user->forceFill(['role' => 'user'])->save();

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertOk();
    $response->assertSee('Dashboard Pelanggan');
    $response->assertDontSee('Panel kontrol');
    $this->actingAs($user)->get('/movies')->assertStatus(200);
    $this->actingAs($user)->get('/showtimes')->assertStatus(200);
});
