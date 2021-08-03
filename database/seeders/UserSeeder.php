<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(
            [
                'app_id' => '86b2754c-c999-11eb-b8bc-0242ac130003',
                'password' => bcrypt('26454b14-44ab-4c02-b4e3-f67e1626266e')
            ]);
    }
}
