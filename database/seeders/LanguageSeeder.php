<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::insert([
            ['code' => 'ne', 'name' => 'Nepali'],
            ['code' => 'en', 'name' => 'English'],
        ]);
    }
}
