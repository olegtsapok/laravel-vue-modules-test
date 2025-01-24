<?php

namespace Tests\Feature\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Module;
use App\Services\Modules;

class ModulesTest extends TestCase
{
    use RefreshDatabase;

    public function testGetZippedModule()
    {
        $model = Module::factory()->create();
        $content = (new Modules)->getZippedModule($model);

        $this->assertNotEmpty($content);
    }
}