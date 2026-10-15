<?php

namespace Tests\Feature\Api\PHPUnit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListFornecedoresTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_resource_fornecedores_route_index(): void
    {
        $URL = '/api/v1/fornecedores';

        $response = $this->get($URL);

        $response->assertStatus(200);
    }
}
