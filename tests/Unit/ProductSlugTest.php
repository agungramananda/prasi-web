<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;

class ProductSlugTest extends TestCase
{
    use RefreshDatabase;

    public function test_slug_is_generated_on_create()
    {
        $p = Product::create([
            'name' => 'My Fancy Product',
            'description' => 'desc',
            'price' => 100,
            'is_active' => true,
        ]);

        $this->assertNotEmpty($p->slug);
        $this->assertEquals('my-fancy-product', $p->slug);
    }

    public function test_slug_uniqueness_appends_suffix()
    {
        $first = Product::create(['name' => 'Dup Product', 'description' => 'x', 'price' => 10, 'is_active' => true]);
        $second = Product::create(['name' => 'Dup Product', 'description' => 'y', 'price' => 20, 'is_active' => true]);

        $this->assertNotEquals($first->slug, $second->slug);
        $this->assertStringStartsWith('dup-product', $second->slug);
    }
}
