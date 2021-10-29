<?php

namespace Database\Seeders;

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
        $this->call(PremissonSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductCategorySeesder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductImageSeesder::class);
        $this->call(TagSeeder::class);
        $this->call(ProductTagSeesder::class);
        $this->call(ProductCoponSeeder::class);
        $this->call(ProductReviewSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CustomerAddressSeeder::class);
        $this->call(ShippingCompanySeeder::class);
        $this->call(PaymenyMethodSeeder::class);
    }
}
