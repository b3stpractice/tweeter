<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<5;$i++)
        {
            User::create(['fullName' => 'guest_'.Str::random(6),
            'username' => 'guest_'.Str::random(6),
            'phone' => '09'.rand(10,39).rand(1111111,9999999),
            'password' => '00000000'
            ]);
        }
    }
}
