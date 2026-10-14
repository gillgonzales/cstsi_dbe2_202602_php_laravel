<?php

namespace Tests\Feature\Api\PHPUnit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListProductsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $URL = '/api/v1/produtos';         //ARRANGE
        $response = $this->get($URL);    //ACT

        $response->assertStatus(200);   //ASSERT
    }
}
