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
    public function test_the_response_of_resource_produtos(): void
    {
        $URL = '/api/v1/produtos';      //ARRANGE
        $response = $this->get($URL);   //ACT

        $response->assertStatus(200);   //ASSERT
    }

    public function test_the_fail_response_of_resource_products(): void
    {
        $URL = '/api/v1/products';      //ARRANGE
        $response = $this->get($URL);   //ACT

        $response->assertStatus(404);   //ASSERT
    }

     public function test_the_json_format_response_of_resource_produtos(): void
    {
        $URL = '/api/v1/produtos';      //ARRANGE
        $response = $this->get($URL);   //ACT

        $response->assertStatus(200);   //ASSERT
        $response->assertJsonIsObject();   //ASSERT
        $response->assertJsonStructure(['data']);   //ASSERT
    }

}
