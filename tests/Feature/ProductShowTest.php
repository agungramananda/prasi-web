<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;

class ProductShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_show_route_returns_view()
    {
        $p = Product::create([
            'name' => 'Visible Product',
            'description' => 'desc',
            'price' => 50,
            'is_active' => true,
            'slug' => 'visible-product',
        ]);

        $response = $this->get(route('products.show', $p->slug));

        $response->assertStatus(200);
        $response->assertSeeText('Visible Product');
    }
}
