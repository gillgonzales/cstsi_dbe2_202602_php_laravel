<?php

namespace Tests\Feature\Api\PHPUnit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
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
        $response->assertJsonStructure(['data'])
            ->assertJson(fn(AssertableJson $json) => $json
                ->whereAllType([
                    'data.0.id' => 'integer',
                    'data.0.nome' => 'string'
                ]));   //ASSERT
    }

    //Referências:
    //https://laravel.com/framework/docs/master/http-tests#available-assertions
    //https://laravel.com/framework/docs/master/http-tests#asserting-json-types
}
