<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use App\Models\User;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->delete();

        $faker = Factory::create();

        $created_by = User::inRandomOrder()->pluck('id')->first();


        for ( $i = 1; $i <= 3; $i++) {

            $user_id = ($i == 1) ? $created_by : null;

            $employees = Employee::create([
                'first_name' => $faker->firstNameMale(),
                'last_name' => $faker->lastName(),
                'address' => $faker->address(),
                'mobile' => str_replace(['-', '(', ')', ' '], '', filter_var($faker->tollFreePhoneNumber() , FILTER_SANITIZE_NUMBER_INT)),
                'gender' => 'm',
                'salary' => $faker->randomFloat(2, 3000, 5000),
                'commission_percentage' => '0.00',
                'join_date' => date('Y-m-d H:i:s'),
                'user_id' => $user_id,
                'created_by' => $created_by,
                'status' => true,
            ]);

        }
    }
}
