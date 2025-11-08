<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocaleTranslationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Ensure default locale is Indonesian
        config(['app.locale' => 'id']);
        config(['app.fallback_locale' => 'id']);
    }

    public function test_product_translation_switching()
    {
        $product = Product::create([
            'price' => 10000,
            'is_active' => true,
            'category' => 'Test'
        ]);
        $product->setTranslations('name', ['id' => 'Gelang Etnik', 'en' => 'Ethnic Bracelet']);
        $product->setTranslations('description', ['id' => 'Deskripsi ID', 'en' => 'Description EN']);
        $product->save();

        // Indonesian
        $this->withSession(['locale' => 'id'])
            ->get(route('products'))
            ->assertSee('Gelang Etnik')
            ->assertDontSee('Ethnic Bracelet');

        // English
        $this->withSession(['locale' => 'en'])
            ->get(route('products'))
            ->assertSee('Ethnic Bracelet')
            ->assertDontSee('Gelang Etnik');
    }
}
