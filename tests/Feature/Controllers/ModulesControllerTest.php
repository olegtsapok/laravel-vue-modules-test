<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Module;

class ModulesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateModule()
    {
        $data = Module::factory()->make()->toArray();
        $response = $this->post('/api/modules', $data);

        $response->assertStatus(201)->assertJson([
            'status' => true,
            'data' => ['module_id' => 1],
        ]);
    }

    public function testDownloadModule()
    {
        $module = Module::factory()->create();
        $response = $this->get('/api/modules/' . $module->id . '/download');

        $response->assertStatus(200);
    }
}