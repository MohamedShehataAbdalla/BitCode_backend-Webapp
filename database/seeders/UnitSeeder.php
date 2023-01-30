<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use App\Models\User;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->delete();

        $user_id = User::pluck('id')->first();

        $faker = Factory::create();

        $units = ["جهاز", "قطعة", "كيلو", "متر"];


        for ( $i = 0; $i < 4; $i++) {

            

            $unit = Unit::create([
                'name' => $units[$i],
                'description' => $faker->text(90),
                'quantity' => '1.00',
                'default' => true,
                'created_by' => $user_id,
                'status' => true,
            ]);

        }
    }
}
