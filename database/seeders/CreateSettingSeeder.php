<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Setting;


class CreateSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        $user = Setting::create([
            'title' => 'BitCode',
            'sub_title' => 'BitCode Company',
            'currency' => 'Egyptian Pound',
            'currency_symbol' => 'EL',
            'email' => 'info@mohamedshehata.online',
        ]);
    }
}
