<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeesder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ProductCategory::create(['name' => 'Women\'s T-Shirts', 'cover' => 'clothes.jpg', 'status' => true , 'category_id' => 1 ]);
        ProductCategory::create(['name' => 'Men\'s T-Shirts', 'cover' => 'clothes.jpg', 'status' => true , 'category_id' => 1]);
        ProductCategory::create(['name' => 'Dresses', 'cover' => 'clothes.jpg', 'status' => true , 'category_id' => 1]);
        ProductCategory::create(['name' => 'Novelty socks', 'cover' => 'clothes.jpg', 'status' => true , 'category_id' => 1]);
        ProductCategory::create(['name' => 'Women\'s sunglasses', 'cover' => 'clothes.jpg', 'status' => true , 'category_id' => 1]);
        ProductCategory::create(['name' => 'Men\'s sunglasses', 'cover' => 'clothes.jpg', 'status' => true , 'category_id' => 1]);

        ProductCategory::create(['name' => 'Women\'s Shoes', 'cover' => 'shoes.jpg', 'status' => true , 'category_id' => 2]);
        ProductCategory::create(['name' => 'Men\'s Shoes', 'cover' => 'shoes.jpg', 'status' => true , 'category_id' => 2]);
        ProductCategory::create(['name' => 'Boy\'s Shoes', 'cover' => 'shoes.jpg', 'status' => true , 'category_id' => 2]);
        ProductCategory::create(['name' => 'Girls\'s Shoes', 'cover' => 'shoes.jpg', 'status' => true , 'category_id' => 2]);

        ProductCategory::create(['name' => 'Women\'s Watches', 'cover' => 'shoes.jpg', 'status' => true , 'category_id' => 3]);
        ProductCategory::create(['name' => 'Men\'s Watches', 'cover' => 'shoes.jpg', 'status' => true , 'category_id' => 3]);
        ProductCategory::create(['name' => 'Boy\'s Watches', 'cover' => 'shoes.jpg', 'status' => true , 'category_id' => 3]);
        ProductCategory::create(['name' => 'Girls\'s Watches', 'cover' => 'shoes.jpg', 'status' => true , 'category_id' => 3]);

        ProductCategory::create(['name' => 'Electronics', 'cover' => 'electronics.jpg', 'status' => true , 'category_id' => 4]);
        ProductCategory::create(['name' => 'USB Flash drives', 'cover' => 'electronics.jpg', 'status' => true , 'category_id' => 4]);
        ProductCategory::create(['name' => 'Headphones', 'cover' => 'electronics.jpg', 'status' => true , 'category_id' => 4]);
        ProductCategory::create(['name' => 'Portable speakers', 'cover' => 'electronics.jpg', 'status' => true , 'category_id' => 4]);
        ProductCategory::create(['name' => 'Cell Phone bluetooth headsets', 'cover' => 'electronics.jpg', 'status' => true , 'category_id' => 4]);
        ProductCategory::create(['name' => 'Keyboards', 'cover' => 'electronics.jpg', 'status' => true , 'category_id' => 4]);

    }
}
