<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\Country;
use App\Models\Language;
use App\Models\Category;
use Faker\Factory as Faker;


class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $countryIds = Country::pluck('id');
        $languageIds = Language::pluck('id');
        $categoryIds = Category::pluck('id');

        foreach (range(1, 100) as $i) {
            News::create([
                'title' => $faker->sentence,
                'content' => $faker->paragraph(4),
                'country_id' => $faker->randomElement($countryIds),
                'language_id' => $faker->randomElement($languageIds),
                'category_id' => $faker->randomElement($categoryIds),
            ]);
        }
    }
}
