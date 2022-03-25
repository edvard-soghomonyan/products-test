<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Author::factory(100)->has(Product::factory()->count(5))->create();
    }
}
