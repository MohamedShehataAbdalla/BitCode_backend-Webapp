<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $this->call(CreatePermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CreateSettingSeeder::class);


        // $this->call(EmployeeSeeder::class);
        // $this->call(CustomerSeeder::class);
        // $this->call(SectionSeeder::class);
        // $this->call(TagSeeder::class);
        // $this->call(TrademarkSeeder::class);
        // $this->call(UnitSeeder::class);
        // $this->call(ProductSeeder::class);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
