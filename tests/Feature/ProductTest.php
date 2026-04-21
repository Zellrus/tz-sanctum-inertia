<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    private string $api_route = 'api';
    public function test_it_can_create_product_with_valid_data(): void
    {
        $category = Category::factory()->create();

        $response = $this->postJson("/{$this->api_route}/products", [
            'name' => 'Test Product',
            'description' => 'Some description',
            'price' => 99.99,
            'category_id' => $category->id,
        ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas("products", [
            'name' => 'Test Product',
            'price' => 99.99,
            'category_id' => $category->id,
        ]);
    }


    public function test_it_fails_if_price_is_negative()
    {
        $category = Category::factory()->create();

        $response = $this->postJson("/{$this->api_route}/products", [
            'name' => 'Bad Product',
            'price' => -10,
            'category_id' => $category->id,
        ]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors('price');
    }


    public function test_it_fails_if_category_does_not_exist()
    {
        $response = $this->postJson("/{$this->api_route}/products", [
            'name' => 'Test Product',
            'price' => 10,
            'category_id' => 999999,
        ]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors('category_id');
    }


    public function test_name_is_required()
    {
        $category = Category::factory()->create();

        $response = $this->postJson("/{$this->api_route}/products", [
            'price' => 10,
            'category_id' => $category->id,
        ]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors('name');
    }

    public function test_it_can_update_product(): void
    {
        $product = Product::factory()->create();

        $category = Category::factory()->create();

        $response = $this->putJson("/{$this->api_route}/products/{$product->id}", [
            'name' => 'Updated Product',
            'description' => 'Updated description',
            'price' => 150.50,
            'category_id' => $category->id,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product',
            'price' => 150.50,
            'category_id' => $category->id,
        ]);
    }
    public function test_it_fails_update_with_invalid_price(): void
    {
        $product = Product::factory()->create();

        $response = $this->putJson("/{$this->api_route}/products/{$product->id}", [
            'name' => 'Test',
            'price' => -50,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('price');
    }
    public function test_it_can_delete_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("/{$this->api_route}/products/{$product->id}");

        $response->assertStatus(204);

        $this->assertSoftDeleted('products', [
            'id' => $product->id,
        ]);
    }

}
