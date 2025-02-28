<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Currency::first())
            return;
        Currency::create([
            'name' => 'جنية مصري',
            'code' => 'ج م',
            'is_default' => true,
            'equal_value' => 1,
        ]);
        Currency::create([
            'name' => 'دولار أمريكي',
            'code' => '$',
            'is_default' => false,
            'equal_value' => 50.5,
        ]);
        Currency::create([
            'name' => 'درهم إماراتي',
            'code' => 'AED',
            'is_default' => false,
            'equal_value' => 13.699,
        ]); Currency::create([
            'name' => 'يورو',
            'code' => '€',
            'is_default' => false,
            'equal_value' => 52.14,
        ]);
    }
}
