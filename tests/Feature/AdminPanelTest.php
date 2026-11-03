<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_is_accessible(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('SAHAARA ADMIN');
    }

    public function test_unauthenticated_user_is_redirected(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_login_and_access_dashboard_and_sidebar_routes(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@sahaara.com',
        ]);
        $this->actingAs($admin);

        // Dashboard
        $response = $this->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Operations Control');

        // Requests
        $response = $this->get('/admin/requests');
        $response->assertStatus(200);

        // Services
        $response = $this->get('/admin/services');
        $response->assertStatus(200);

        // Graveyards
        $response = $this->get('/admin/graveyards');
        $response->assertStatus(200);

        // Janazahs
        $response = $this->get('/admin/janazahs');
        $response->assertStatus(200);

        // Volunteers
        $response = $this->get('/admin/volunteers');
        $response->assertStatus(200);

        // Cities
        $response = $this->get('/admin/cities');
        $response->assertStatus(200);
    }
}
