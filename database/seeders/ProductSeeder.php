<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $dataPath = database_path('data');

        $categories = json_decode(File::get($dataPath.'/categories.json'), true);
        $categoryMap = [];

        foreach ($categories as $cat) {
            $model = Category::updateOrCreate(
                ['slug' => $cat['slug']],
                [
                    'name' => $cat['name'],
                    'description' => $cat['description'] ?: null,
                    'image' => $cat['image'],
                ]
            );
            $categoryMap[$cat['slug']] = $model->id;
        }

        $products = json_decode(File::get($dataPath.'/products.json'), true);

        foreach ($products as $p) {
            $categoryId = null;
            foreach ($p['categories'] as $slug) {
                if (isset($categoryMap[$slug])) {
                    $categoryId = $categoryMap[$slug];
                    break;
                }
            }

            $product = Product::updateOrCreate(
                ['slug' => $p['slug']],
                [
                    'category_id' => $categoryId,
                    'name' => $p['name'],
                    'sku' => $p['sku'],
                    'price' => $p['price'],
                    'regular_price' => $p['regular_price'],
                    'short_description' => $p['short_description'],
                    'description' => $p['description'],
                    'attributes' => $p['attributes'],
                    'image' => $p['images'][0] ?? null,
                    'in_stock' => $p['in_stock'] ?? true,
                ]
            );

            $product->images()->delete();
            foreach ($p['images'] as $i => $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $image,
                    'sort_order' => $i,
                ]);
            }
        }
    }
}
