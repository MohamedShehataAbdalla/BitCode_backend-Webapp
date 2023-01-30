<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use App\Models\Section;
use App\Models\User;
use App\Models\Trademark;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Tag;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();

        $faker = Factory::create();

        $sections = Section::all();

        $user_id = User::pluck('id')->first();

        foreach ($sections as $section) {

            for ( $i = 1; $i <= 10; $i++) {

                $unit_id = Unit::inRandomOrder()->pluck('id')->first();
                $trademark_id = Trademark::inRandomOrder()->pluck('id')->first();

                $product = Product::create([
                    'barcode' => $faker->unique()->numberBetween(1000000000000, 9999999999999),
                    'name' => $faker->word(2),
                    'description' => $faker->text(90),
                    'price' => $faker->randomFloat(2, 25, 5000),
                    'unit_id' => $unit_id,
                    'trademark_id' => $trademark_id,
                    'section_id'   => $section->id,
                    'created_by' => $user_id,
                    'status' => true,
                ]);

                $tags = Tag::inRandomOrder()->take(3)->pluck('id')->toArray();

                // $tags['user_id'] = $user_id;

                $product->tags()->attach($tags);

            }
        }
    }
}
