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

        DB::table('users')->insert([
            'name' => 'Zoltan',
            'email' => 'mzuty91@gmail.com',
            'password' => Hash::make('kiazaki91es'),
        ]);

        DB::table('paymenth_methods')->insert([
            'payment_type' => 'Utánvét'
        ]);

        DB::table('shipping_methods')->insert([
            'shipping_type' => 'GLS futár',
            'cost' => 1990
        ]);
    }
}
