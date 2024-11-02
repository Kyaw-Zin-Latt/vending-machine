<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Currency;
use App\Models\Product;
use App\Models\User;
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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->count(10)->create();

        $currencies = [
            [
                "currency_symbol" => '$',
                "currency_short_form" => 'USD'

            ],
            [
                "currency_symbol" => 'K',
                "currency_short_form" => 'MMK'
            ],
            [
                "currency_symbol" => '฿',
                "currency_short_form" => 'THB'
            ]
        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }

        Product::factory()->count(12)->create();

    }
}
