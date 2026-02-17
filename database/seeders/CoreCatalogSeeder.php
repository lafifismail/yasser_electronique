<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class CoreCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update Smartphone category
        $category = Category::updateOrCreate(
            ['slug' => 'smartphone'],
            [
                'name' => 'Smartphone',
                'is_active' => true,
            ]
        );

        // Create or update Apple brand
        $brand = Brand::updateOrCreate(
            ['slug' => 'apple'],
            [
                'name' => 'Apple',
                'is_active' => true,
            ]
        );

        // Create or update iPhone 13 128GB product
        $product = Product::updateOrCreate(
            ['sku' => 'IP13-128-BLK'],
            [
                'category_id' => $category->id,
                'brand_id' => $brand->id,
                'name' => 'iPhone 13 128GB',
                'slug' => 'iphone-13-128gb',
                'condition' => 'refurbished',
                'warranty_months' => 12,
                'price_cents' => 49900,
                'vat_rate' => 22.00,
                'stock_qty' => 3,
                'is_active' => true,
                'short_description' => 'iPhone 13 Ricondizionato - 128GB Nero',
                'description' => 'iPhone 13 ricondizionato in ottime condizioni. Display Super Retina XDR da 6.1", chip A15 Bionic, sistema a doppia fotocamera da 12MP. Garanzia 12 mesi.',
            ]
        );

        // Delete existing images and attributes to ensure clean re-seed
        $product->images()->delete();
        $product->attributes()->delete();

        // Create product images
        ProductImage::create([
            'product_id' => $product->id,
            'path' => 'assets/img/products/iphone-13-main.jpg',
            'alt' => 'iPhone 13 128GB Nero - Vista frontale',
            'sort_order' => 0,
            'is_main' => true,
        ]);

        ProductImage::create([
            'product_id' => $product->id,
            'path' => 'assets/img/products/iphone-13-back.jpg',
            'alt' => 'iPhone 13 128GB Nero - Vista posteriore',
            'sort_order' => 1,
            'is_main' => false,
        ]);

        ProductImage::create([
            'product_id' => $product->id,
            'path' => 'assets/img/products/iphone-13-side.jpg',
            'alt' => 'iPhone 13 128GB Nero - Vista laterale',
            'sort_order' => 2,
            'is_main' => false,
        ]);

        // Create product attributes
        ProductAttribute::create([
            'product_id' => $product->id,
            'attribute_key' => 'ram',
            'value' => '4GB',
            'sort_order' => 0,
        ]);

        ProductAttribute::create([
            'product_id' => $product->id,
            'attribute_key' => 'storage',
            'value' => '128GB',
            'sort_order' => 1,
        ]);

        ProductAttribute::create([
            'product_id' => $product->id,
            'attribute_key' => 'color',
            'value' => 'Black',
            'sort_order' => 2,
        ]);
    }
}
