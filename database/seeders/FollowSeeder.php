<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FollowSeeder extends Seeder
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
            if($user->id != 5)
            {
            $user->followings()->attach($user->id + 1);
            User::find($user->id)->update([
                'following' => DB::raw('following+1'),
            ]);
            User::find($user->id + 1)->update([
                'followers' => DB::raw('followers+1'),
            ]);
            }
            if($user->id != 1)
            {
                $user->followings()->attach($user->id - 1);
                User::find($user->id)->update([
                  'following' => DB::raw('following+1'),
                ]);
                User::find($user->id - 1)->update([
                  'followers' => DB::raw('followers+1'),
                ]);
            }

        }
    }
}
