<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        factory(\App\Models\Category::class, 10)->create();
    }
}
