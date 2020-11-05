<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class TweetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach($users as $user)
        {
            for($i=0;$i<3;$i++)
            {
                $user->tweets()->create(['text' => Str::random(rand(10,200))]);
            }
        }
    }
}
