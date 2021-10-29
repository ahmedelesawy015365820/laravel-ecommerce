<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PremissonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'Permission-list',
            'Permission-show',
            'Permission-create',
            'Permission-edit',
            'Permission-delete',
            'categories',
            'Category-create',
            'Category-edit',
            'Category-delete',
            'Category-list',
            'product-categories-list',
            'product-categories-show',
            'product-categories-create',
            'product-categories-edit',
            'product-categories-delete',
            'tag-list',
            'tag-create',
            'tag-edit',
            'tag-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'coupon-list',
            'coupon-create',
            'coupon-edit',
            'coupon-delete',
            'review-list',
            'review-show',
            'review-edit',
            'review-delete',
            'country-state',
            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',
            'country-list',
            'country-create',
            'country-edit',
            'country-delete',
            'city-list',
            'city-create',
            'city-edit',
            'city-delete',
            'state-list',
            'state-create',
            'state-edit',
            'state-delete',
            'address-list',
            'address-create',
            'address-edit',
            'address-delete',
            'shipping-list',
            'shipping-create',
            'shipping-edit',
            'shipping-delete',
            'paymentmethod-list',
            'paymentmethod-create',
            'paymentmethod-edit',
            'paymentmethod-delete',
            'order-list',
            'order-create',
            'order-edit',
            'order-delete',
            ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

    }
}
