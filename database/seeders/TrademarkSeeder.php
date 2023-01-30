<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use App\Models\User;
use App\Models\Trademark;

class TrademarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trademarks')->delete();

        $user_id = User::pluck('id')->first();

        $faker = Factory::create();

        $trademarks = ["سامسونج Samsung", "ديل Dell", "مايكروسوفت Microsoft", "أتش بي HP", "المراعي Almaraei", "كريازي kiriazi"];


        for ( $i = 0; $i < 6; $i++) {

            $trademark = Trademark::create([
                'name' => $trademarks[$i],
                'description' => $faker->text(90),
                'created_by' => $user_id,
                'status' => true,
            ]);

        }
    }
}
