<?php

namespace App\Repositories\Eloquent\Auth;

use App\Models\User;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\Auth\LoginRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginRepository extends UserRepository implements LoginRepositoryInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function checkPassword($phone,$password)
    {
        $user = $this->model->where('phone',$phone)->first();
        if(Hash::check($password, $user->password ?? null))
        return $user;
        else
        return false;
    }

    public function updateToken($user) : Model
    {
        $user->api_token = Str::random(60);
        $this->update(['api_token' => $user->api_token],$user->id);
        return $user;
    }

}
