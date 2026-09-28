<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogCategoryFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_page_preserves_price_filter_when_switching_category_links(): void
    {
        $brennholz = Category::factory()->create(['name' => 'Brennholz', 'slug' => 'brennholz']);
        $pellets = Category::factory()->create(['name' => 'Holzpellets', 'slug' => 'holzpellets']);

        Product::factory()->create(['category_id' => $brennholz->id, 'price' => 80, 'name' => 'Buche cheap']);
        Product::factory()->create(['category_id' => $pellets->id, 'price' => 90, 'name' => 'Pellets cheap']);

        $response = $this->get(route('category', [
            'slug' => 'brennholz',
            'price_range' => ['0-100'],
        ]));

        $response->assertOk();
        $response->assertSee('Refine by', false);
        $response->assertSee('Brennholz', false);
        $response->assertSee('page-header__image', false);
        $response->assertSee('product-category/holzpellets', false);
        $response->assertSee('price_range', false);
    }

    public function test_shop_keeps_price_and_category_filters_together(): void
    {
        $brennholz = Category::factory()->create(['name' => 'Brennholz', 'slug' => 'brennholz']);
        Product::factory()->create(['category_id' => $brennholz->id, 'price' => 80, 'name' => 'Buche cheap']);
        Product::factory()->create(['category_id' => $brennholz->id, 'price' => 300, 'name' => 'Buche expensive']);

        $response = $this->get(route('shop', [
            'product_cat' => ['brennholz'],
            'price_range' => ['0-100'],
        ]));

        $response->assertOk();
        $response->assertSee('Buche cheap', false);
        $response->assertDontSee('Buche expensive', false);
        $response->assertSee('page-header__image', false);
    }
}
