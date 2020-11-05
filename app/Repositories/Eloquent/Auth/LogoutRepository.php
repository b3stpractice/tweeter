<?php

namespace App\Repositories\Eloquent\Auth;

use App\Models\User;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\Auth\LogoutRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class LogoutRepository extends UserRepository implements LogoutRepositoryInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function removeToken($request) : Bool
    {
        $userId = $this->model->where('api_token',$request->bearerToken())->first()->id;
        return $this->update(['api_token' => NULL],$userId);
    }
}
