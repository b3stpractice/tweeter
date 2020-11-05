<?php

namespace App\Repositories\Interfaces\Auth;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

interface LogoutRepositoryInterface extends UserRepositoryInterface
{
    public function removeToken($request) : Bool;
}
