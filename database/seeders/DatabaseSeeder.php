<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $payment_methods = [
            [
                'name' => 'Utánvét',
                'value' => 'cod',
                'cost' => 450,
                'provider' => ''
            ],
            [
                'name' => 'Online kártyával',
                'value' => 'stripe',
                'cost' => 0,
                'provider' => 'Stripe'
            ]
        ];
        $shipping_methods = [
            [
                'name' => 'Házhoz szállítás',
                'value' => 'home',
                'cost' => 1990,
                'provider' => 'GLS'
            ],
            [
                'name' => 'Csomagpont, automata',
                'value' => 'point',
                'cost' => 990,
                'provider' => 'GLS'
            ]
        ];
        $categories = [
            [
                'title' => 'Floráriumok',
                'slug' => 'florariumok',
                'image' => 'categories/01JCDDQSBXT8ZYPQWZ7MV3BKZ2.jpg',
            ],
            [
                'title' => 'Lámpák',
                'slug' => 'lampak',
                'image' => 'categories/01JCDDRGCQ4V0NT2879VT3WT84.jpg',
            ]
        ];
        $products = [
            [
                'name' => 'Prehisztorik florárium',
                'slug' => 'florarium-dino-figuraval',
                'description' => '<p>Csodás élő zöld florárium egy kis dinó figurával díszítve.</p>',
                'images' => '["products/01JCDE4QAKWWEW7XSJN13JC742.jpg"]',
                'price' => 15000,
                'tax' => 0.27,
                'quantity' => 5,
            ],
            [
                'name' => 'Florarium éjjeli lámpa',
                'slug' => 'allo-ejjeli-lampa-florariummal',
                'description' => '<p>Modern és természetközeli.</p>',
                'images' => '["products/01JCDE6CK73MHYNY4YF24EGD96.jpg"]',
                'price' => 25000,
                'tax' => 0.27,
                'quantity' => 1,
            ]
        ];
        $filter_groups = [
            [
                'name' => 'Méret',
                'slug' => 'meret',
                'order' => 1
            ],
            [
                'name' => 'Kinek',
                'slug' => 'kinek',
                'order' => 2
            ]
        ];
        $filter_options = [
            [
                'filter_group_id' => 1,
                'name' => 'Kicsi',
                'value' => 'kicsi',
                'order' => 1
            ],
            [
                'filter_group_id' => 1,
                'name' => 'Nagy',
                'value' => 'nagy',
                'order' => 2
            ],
            [
                'filter_group_id' => 2,
                'name' => 'Barát, barátnő',
                'value' => 'barat',
                'order' => 1
            ],
            [
                'filter_group_id' => 2,
                'name' => 'Fantasy kedvelő',
                'value' => 'fantasy',
                'order' => 2
            ]
        ];

        DB::table('users')->insert([
            'name' => 'Zoltan',
            'email' => 'mzuty91@gmail.com',
            'password' => Hash::make('kiazaki91es'),
        ]);

        DB::table('paymenth_methods')->insert($payment_methods);
        DB::table('shipping_methods')->insert($shipping_methods);
        DB::table('categories')->insert($categories);
        DB::table('products')->insert($products);
        DB::table('category_product')->insert([
            ['category_id' => 1, 'product_id' => 1],
            ['category_id' => 1, 'product_id' => 2],
            ['category_id' => 2, 'product_id' => 2]
        ]);
        DB::table('filter_groups')->insert($filter_groups);
        DB::table('filter_options')->insert($filter_options);
        DB::table('filter_options_product')->insert([
            ['product_id' => 1, 'filter_options_id' => 2],
            ['product_id' => 1, 'filter_options_id' => 3],
            ['product_id' => 1, 'filter_options_id' => 4],
            ['product_id' => 2, 'filter_options_id' => 1],
            ['product_id' => 2, 'filter_options_id' => 3],
        ]);
    }
}
