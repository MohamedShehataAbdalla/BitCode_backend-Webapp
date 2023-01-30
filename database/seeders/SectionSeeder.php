<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use App\Models\User;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->delete();

        $user_id = User::pluck('id')->first();

        $faker = Factory::create();


        for ( $i = 1; $i <= 8; $i++) {

            $sections = Section::create([
                'name' => $faker->word(2),
                'description' => $faker->text(90),
                'parent_id' => null,
                'created_by' => $user_id,
                'status' => true,
            ]);

        }
    }
}
