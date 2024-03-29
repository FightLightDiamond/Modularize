<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModularizeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $params = [
            'namespace' => '',
            'path' => '',
            'table' => 'users',
            'provider' => true,
            'repository' => true,
            'model' => true,
            'request' => true,
            'policy' => true,
            'route' => true,
            'service' => true,
            'test' => true,

        ];

        $response = $this->post(route('api.render'), $params);
        $response->assertStatus(200);
    }
}
