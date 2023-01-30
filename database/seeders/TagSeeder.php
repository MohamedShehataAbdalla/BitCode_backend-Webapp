<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use App\Models\User;
use App\Models\Tag;


class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->delete();

        $user_id = User::pluck('id')->first();

        $faker = Factory::create();

        $colors = ["#700000", "#C80000", "#787878", "#FFFF99", "#FF3399", "#99CC00", "#33CCFF", "#9900FF", "#FFCCCC", "#FF9900"];

        for ( $i = 0; $i < 10; $i++) {

            $tag = Tag::create([
                'name' => $faker->word(2),
                'color' => $colors[$i],
                'created_by' => $user_id,
                'status' => true,
            ]);

        }
    }
}
