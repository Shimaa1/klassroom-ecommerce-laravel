<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Models\Product::class, 20)->create();

        $products = \App\Models\Product::select('id')->get();

        foreach ($products as $product){
            $product->addMediaFromUrl("https://via.placeholder.com/640x480.png/00dd44?text=product_$product->id")->toMediaCollection('products');
        }

    }
}
