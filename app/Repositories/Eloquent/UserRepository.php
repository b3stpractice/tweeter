<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new User());
    }

    public function checkPassword($email,$password)
    {
        $user = $this->model->where('email',$email)->first();
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

    public function removeToken($request) : Bool
    {
        $api_token = substr($request->header('authorization'),7,strlen($request->header('authorization'))-7);
        $userId = $this->model->where('api_token',$api_token)->first()->id;
        return $this->update(['api_token' => NULL],$userId);
    }
}
